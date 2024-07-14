@php
  $login_register_path = ["auth/login", "auth/registration"];
  $pathname = request()->path();
  $enctype = $pathname === "auth/registration" ? "multipart/form-data" : "";
@endphp

<div>
  <form class="space-y-[18px]" action="{{ $action }}" method="{{ $method }}" enctype="{{ $enctype }}">
    @csrf
    @method($method)
    <div class="rounded-md shadow-sm space-y-[17px]">
      @switch(request()->fullUrl())
        @case(route('login.form'))
          <x-inputs.input name="email" type="email" label="email" placeholder="your email" />
          <x-inputs.input name="password" type="password" label="password" placeholder="your password" />
          @break
        @case(route('register.form'))
          <x-inputs.input name="first_name" type="text" label="first name" placeholder="first name" />
          <x-inputs.input name="last_name" type="text" label="last name" placeholder="last name" />
          <x-inputs.input name="email" type="email" label="email" placeholder="your email" />
          <x-inputs.input name="password" type="password" label="password" placeholder="type a strong password" />
          <x-inputs.input name="password_confirmation" type="password" label="confirm password" placeholder="confirm your password" />
          <x-inputs.file_input name="profile_picture" label="profile picture" />
          @break
        @case(route('password.email.form'))
          <x-inputs.input name="email" type="email" label="email" placeholder="your email" />
          @break
        @case(route('password.reset.form', ['token' => $token]))
          <input name="token" type="hidden" value="{{ $token }}" />
          <x-inputs.input name="password" type="password" label="new password" placeholder="new password" />
          <x-inputs.input name="password_confirmation" type="password" label="confirm new password" placeholder="confirm new password" />
          @break
        @default
          <span class="hidden">{{ error_log("new route found for auth form. the new pathname was - " . request()->fullUrl()) }}</span>
      @endswitch
    </div>
    @if(in_array($pathname, $login_register_path))
    <div>
      @if ($pathname === "auth/login")
        <p class="text-[#41af27] text-end mb-4"><a href="{{ route('password.email.form') }}">Forgot password</a></p>
        <p class="text-gray-600">If you haven't any account <a class="font-bold text-[#41af27]" href="{{ route('register.form') }}">Sign up here.</a></p>
      @endif
      @if($pathname === "auth/registration")
        <p class="text-gray-600">If already you have an account <a class="font-bold text-[#41af27]" href="{{ route('login.form') }}">login here.</a></p>
      @endif
    </div>
    @endif
    <x-buttons.auth_button />
    {{-- <RenderAuthLink /> --}}
    {{-- <AuthSubmitButton title={pathname === "/auth/login" ? "Sign in" : "Submit"}/> --}}
  </form>
</div>