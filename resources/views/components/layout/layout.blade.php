@php
  $reset_pass_token = request()->token ?? 'token';
  $auth_path = [route('login.form'), route('register.form'), route('verification.notice'), route('password.email.form'), route('password.reset.form', ['token' => $reset_pass_token])];
  $pathname = request()->fullUrl();
  $public_path = [route('about_us')];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ str_replace('_', ' ', config('app.name')) }}</title>
        <link rel="icon" href={{ asset('favicon.ico') }} />
        @vite('resources/css/app.css')
    </head>
    <body class="bg-[#f9fafb]">
      {{-- layout --}}
      @if (in_array($pathname, $auth_path))
        <div class="grid place-items-center h-screen">
          <x-ui.main_nav />
          <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
              <x-ui.auth_header />
              @yield('children')
            </div>
          </div>
        </div>
      @else
        <x-ui.main_nav />
          <main id="mainContainer">
            <div class="container mx-auto px-4">
              @yield('children')
            </div>
          </main>
      @endif
      {{-- end layout --}}
        
      {{-- toastify --}}
      @if(session('message'))
        <x-ui.toastify />
      @endif

      {{-- app scripts --}}
      @vite('resources/js/app.js')
      @if(!in_array($pathname, $auth_path))
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          addPaddingToMainContainer();
        });
        document.addEventListener('scroll', window.stickyNav);
      </script>
      @endif
      @if(session('message'))
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          showToast(5000);
          // here I am set the duration of showToast manually.
          // You can add the duration time in session to make it dynamic.
          // demo:
          // showToast({{ session('duration') }});
        });
      </script>
      @endif
    </body>
</html>
<!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->