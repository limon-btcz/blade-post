<nav id="navbar" class="fixed top-0 left-0 w-full z-40 bg-white shadow-md">
  <div class="container mx-auto px-4">
    <div class="flex justify-between">
      <div class="flex space-x-4">
        <!-- Logo -->
        <div class="w-20 h-20">
          <a href="{{ route('posts.index') }}" class="flex items-center">
            <img src="{{ asset('logo.png') }}" alt="" class="mr-2" />
          </a>
        </div>
      </div>
      <!-- Primary Nav -->
      <div class="flex items-center space-x-1">
        @auth
        <a href="{{ route('posts.index') }}" class="nav_links">home</a>
        <a href="{{ route('posts.create') }}" class="nav_links">create post</a>
        <a href="{{ route('logout') }}" class="nav_links order-2">log out</a>
        @endauth
        @guest
        @if(request()->fullurl() !== route('login.form'))
        <a href="{{ route('login.form') }}" class="nav_links order-2">log in</a>
        @endif
        @endguest
        <a href="{{ route('about_us') }}" class="nav_links">about us</a>
      </div>
    </div>
  </div>
</nav>