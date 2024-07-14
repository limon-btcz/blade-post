<div class="w-full h-screen">
  <div class="flex-col items-center flex justify-center h-full">
    <h1 class="text-[160px] text-[#41af27] font-normal">{{ $statusCode }}</h1>
    <p class="text-3xl mb-[12px] text-gray-900">
      <span class="w-7 h-7 rounded-full bg-gray-900 text-white leading-7 text-center font-black inline-block">!</span>
      @if($statusCode === 404)
          Oops! Page not found.
        @else
          Oops! Something went wrong.
      @endif
    </p>
    <p class="text-2xl mb-[26px] text-gray-900">
      @if($statusCode === 404)
        The page you requested was not found.
      @elseif($statusCode === 500)
        Server error. Please try again later.
      @else
        Please try again later. Or contact to admin.
      @endif
    </p>
    <div>
      <a href="/" class="custom_transition px-11 py-[14px] bg-[#41af27] hover:bg-[#41af27]/80 text-lg font-semibold rounded-[50px] capitalize text-white">Back to home</a>
    </div>
  </div>
</div>