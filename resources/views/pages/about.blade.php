@extends('components.layout.layout')

@section('children')
<div class="flex flex-wrap items-center justify-center">
  <!-- Image container -->
  <div class="w-full md:w-4/12 flex justify-center">
    <img src="{{ asset('kiam_khan_limon.jpg') }}" alt="Your Name" class="rounded-lg shadow-md h-auto max-w-full max-h-96 object-cover">
  </div>
  <!-- About details container -->
  <div class="mt-4 w-full md:mt-0 md:w-8/12 md:pl-4">
    <h2 class="text-2xl font-semibold capitalize">Kiam Khan Limon</h2>
    <p class="mt-2 text-gray-600">
      This is a demo project of simple blog post with laravel. 
      I use blade template for frontend. 
      Actually I focus auth system to this project.
      If you want to test this project try all auth routes.
      <span class="block">By the way,</span>
      Hi! I am from Bangladesh. 
      I'm student of management but I love programming. 
      I have experienced with javascript and php. 
      Recently I'm working with laravel. 
      Laravel is a php framework. 
      When I work with frontend I use to code with reactjs or nextjs. 
      Nextjs is react framework.
      <span class="block mt-4">If you want to contact with me choose one of my contact link down below,</span>
    </p>
    <div class="mt-4 flex items-center space-x-1">
      <a target="_blank" href="https://wa.me/+8801568113207" class="social_links bg-[#41af27] hover:bg-[#41af27]/80">WhatsApp</a>
      <a target="_blank" href="mailto:mdlimon0175@gmail.com" class="social_links bg-[#41af27] hover:bg-[#41af27]/80">Email</a>
      <a target="_blank" href="https://www.facebook.com/limon.btcz" class="social_links bg-blue-600 hover:bg-blue-700">Facebook</a>
      <a target="_blank" href="https://github.com/limon-btcz" class="social_links bg-gray-800 hover:bg-gray-900">GitHub</a>
    </div>
  </div>
</div>
@endsection
{{-- <div>
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div> --}}
