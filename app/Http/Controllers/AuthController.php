<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
  private $server_err_msg = 'Something went wrong! Please try again later or contact to admin.';
  private $registration_success_msg = 'Registration successful! Please check your mail to verify your email address. Without verification you can\'t login';

  // user registration
  public function registration(Request $request) {
    $validator = Validator::make($request->all(), [
      'first_name' => 'required|string|min:3|max:20',
      'last_name' => 'required|string|min:3|max:20',
      'email' => 'required|email:rfc,dns|unique:users,email',
      'profile_picture' => 'nullable|mimes:jpg,png|max:1024',
      'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->symbols()]
    ]);

    if($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

    // file validation
    $file_store_location = '';
    if ($request->hasFile('profile_picture')){
      $file = $request->file('profile_picture');
      $fileName = $file->getClientOriginalName();
      $fileName = pathinfo($fileName, PATHINFO_FILENAME);
      $extension = $file->extension();
      $name = str_replace(' ', '-', $fileName) . '-' . time() . rand(1, 100) . '.' . $extension;
      $store_path = 'uploads/users';
      $file->move(public_path($store_path), $name);
      $file_store_location = $store_path . '/' . $name;
    }

    $user = new User();
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->profile_picture = $file_store_location;
    $user->email = $request->email;
    $user->email_code = $email_code = Str::random(40);
    $user->password = Hash::make($request->password);
    $user->save();

    // send email verification mail
    $this->send_verification_mail($user, $email_code);
    session(['new_register_email' => $user->email]);

    return redirect()->route('login.form')->with(['message' => $this->registration_success_msg, 'status' => true]);
  }

  // user login
  public function login(Request $request) {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email:rfc,dns',
      'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

    if (Auth::attempt($request->only(['email', 'password']))) {
      $user = Auth::user();

      if(!$user->hasVerifiedEmail()) {
        Auth::logout();
        return redirect()->route('verification.notice')->with(['message' => 'Verify your email to login!', 'status' => false]);
      }
      $request->session()->regenerate();
      return redirect()->route('posts.index');
    }

    return redirect()->route('login.form')
      ->with(['message' => 'User not found!', 'status' => false]);
  }

  // user log out
  public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login.form');
  }

  // verify email
  public function verify(Request $request) {
    $user = $this->is_user_exist($request->email);

    if (!$user || !$this->email_authorize($request->only('email_code'), $user)) {
      return redirect()->route('verification.notice')
        ->with(['message' => 'Failed to verify your email. Please try again later.', 'status' => false]);
    }

    if ($user && $user->hasVerifiedEmail()) {
      return redirect()->route('login.form')
        ->with(['message' => 'Your email already verified', 'status' => true]);
    }

    if($user && !$user->hasVerifiedEmail()) {
      $user->email_code = null;
      $user->email_verified_at = now()->toDateTimeString();
      $user->save();
      event(new Verified($user));

      session()->forget('new_register_email');
      Auth::login($user);
      return redirect()->route('posts.index');
    }
  }

  // forgot password request
  public function forgot_password(Request $request) {
    $validator = Validator::make($request->only('email'), [
      'email' => 'required|email:rfc,dns'
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

    $user = $this->is_user_exist($request->email);

    if(!$user) {
      return back()->with(['message' => 'User not found!', 'status' => false]);
    }

    if(!$user->hasVerifiedEmail()) {
      return back()->with(['message' => $this->server_err_msg, 'status' => false]);
    }
  
    $link_sent_status = Password::sendResetLink($request->only('email'));
    if($link_sent_status === Password::RESET_LINK_SENT) {
      session(['forgot_password_email' => $request->email]);
      return back()->with(['message' => 'Check your email to rest password.', 'status' => true]);
    }

    return back()->with(['message' => $this->server_err_msg, 'status' => false]);
  }

  // reset forgot password view
  public function reset_password_form(string $token) {
    return view('auth.reset_password', ['token' => $token]);
  }

  // reset forgot password
  public function reset_password(Request $request) {
    $validator = Validator::make($request->all(), [
      'token' => 'required|string',
      'password' => ['required', 'confirmed', PasswordRule::min(8)->mixedCase()->numbers()->symbols()]
    ], [
      'token.*' => 'Please try again later.'
    ]);

    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }

    $user = $this->is_user_exist(session('forgot_password_email'));
    if(!$user) {
      return back()->with(['message' => 'invalid request', 'status' => false]);
    }

    $credentials = [
      'email' => $user->email,
      'password' => $request->password,
      'password_confirmation' => $request->password_confirmation,
      'token' => $request->token
    ];

    $reset_password_status = Password::reset($credentials, function(User $user, string $password) {
      $user->forceFill([
        'password' => Hash::make($password)
      ])->save();

      event(new PasswordReset($user));
    });

    if($reset_password_status === Password::PASSWORD_RESET) {
      session()->forget('forgot_password_email');
      return redirect()->route('login.form')
        ->with(['message' => 'Your password has been reset successfully.', 'status' => true]);
    }

    return back()->with(['message' => $this->server_err_msg, 'status' => false]);
  }

  // resend email code
  public function resend_email_verification() {
    $user = $this->is_user_exist(session('new_register_email'));

    if($user) {
      $this->resend_verification($user);
      return back()->with(['message' => 'Verification link sent!', 'status' => true]);
    }

    return back()->with(['message' => $this->server_err_msg, 'status' => false]);
  }

  private function email_authorize(array $credentials, $user) {
    // here we check only email_code. for security we add more info for authorization.
    if(!is_null($user->email_code) && !hash_equals(sha1($user->email_code), $credentials['email_code'])) {
      return false;
    }

    return true;
  }

  private function is_user_exist(string|null $email) {
    if($email) {
      $user = User::where('email', $email)->first();
      return $user;
    }
    return false;
  }

  private function send_verification_mail(object $user, string $email_code) {
    $subject = "Veryfy Email for " . config("app.name");
    $title = "Verify email";
    $user_name = $user->first_name . " " . $user->last_name;
    $message = "Verify your email to login in " . config("app.name");
    $link = config("app.url") . "/auth/verify?email=" . $user->email . "&email_code=" . sha1($email_code);
    Mail::to($user->email)->send(new AuthMail($subject, $title, $user_name, $message, $link));
  }

  private function resend_verification(object $user) {
    $user->email_code = $email_code = Str::random(40);
    $user->save();

    $subject = "Veryfy Email for " . config("app.name");
    $title = "Verify email";
    $user_name = $user->first_name . " " . $user->last_name;
    $message = "Verify your email to login in " . config("app.name");
    $link = config("app.url") . "/auth/verify?email=" . $user->email . "&email_code=" . sha1($email_code);
    Mail::to($user->email)->send(new AuthMail($subject, $title, $user_name, $message, $link));
  }
}