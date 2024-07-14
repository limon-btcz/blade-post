@php
  $user_name = $post->user->first_name . " " . $post->user->last_name;
  $user_profile = $post->user->profile_picture ? config('app.url') . "/" . $post->user->profile_picture : null;
  $post_image = $post->image ? config('app.url') . "/" . $post->image : null;
@endphp
<div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-4 xl:col-span-3">
  <div class="overflow-hidden rounded-lg bg-white shadow-md">
    <a href="{{ route('posts.show', ["post" => $post->slug]) }}">
      <img src="{{ $post_image ?? asset("empty.jpg") }}" alt="" class="h-64 w-full object-cover" />
    </a>
    <div class="p-4 space-y-3">
      <h2 class="text-xl font-bold text-gray-800">
        <a href="{{ route('posts.show', ["post" => $post->slug]) }}">{{ $post->title }}</a>
      </h2>
      <div class="flex justify-between">
        <p class="text-sm text-gray-600">by {{ $user_name }}</p>
        <p class="text-sm text-gray-600 text-end">{{ $post->created_at->diffForHumans() }}</p>
      </div>
      <p class="text-gray-700">{{ rtrim(substr($post->content, 0, 80)) . "..." }}</p>
    </div>
  </div>
</div>
{{-- 
<p class="">{{ $user_name }}</p>
      <p class="">{{ $post->created_at }}</p> --}}