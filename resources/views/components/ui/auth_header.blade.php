@php
  $authHeader = [
    route('login.form') => 'Login to your account',
    route('register.form') => 'Create your account',
    route('password.email.form') => 'Forgot Password',
    route('password.reset.form', ['token' => request()->token ?? "token"]) => 'Reset Password',
    route('verification.notice') => 'Verify Your Email Address',
  ];

@endphp

<div>
  <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
    {{ $authHeader[request()->fullUrl()] }}
  </h2>
</div>