@php
  $user_name = $post->user->first_name . " " . $post->user->last_name;
  $user_profile = $post->user->profile_picture ? config('app.url') . "/" . $post->user->profile_picture : null;
  $post_image = $post->image ? config('app.url') . "/" . $post->image : null;
@endphp
@extends('components.layout.layout')

@section('children')
<div class="mx-auto max-w-2xl rounded-lg border border-gray-200 bg-white p-8 mt-6 shadow-md">
  <img class="h-64 w-full rounded-t-lg object-cover object-center" src="{{ $post_image ?? asset("empty.jpg") }}" alt="" />
  <div class="p-5">
    <h2 class="mb-2 text-2xl font-bold">{{ $post->title }}</h2>
    <p class="mb-4 text-gray-700">{{ $post->content }}</p>

    <!-- User Profile -->
    <div class="mb-4 flex items-center">
      <img class="mr-4 h-10 w-10 rounded-full" src="{{ $user_profile }}" alt="" />
      <div class="text-sm">
        <p class="leading-none text-gray-900">{{ $user_name }}</p>
        <p class="text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
      </div>
    </div>

    <!-- Edit and Delete Options -->
    <div class="flex items-center justify-end space-x-3">
      <a href="{{ route('posts.edit', ["post" => $post->slug]) }}" class="rounded bg-blue-500 px-3 py-1 text-white hover:bg-blue-700">Edit</a>
      <form method="POST" action="{{ route('posts.destroy', ["post" => $post->slug]) }}">
        @method('DELETE')
        @csrf
        <button class="rounded bg-red-500 px-3 py-1 text-white hover:bg-red-700" type="submit">Delete</button>
      </form>
    </div>
  </div>
</div>
@endsection
<!-- Nothing worth having comes easy. - Theodore Roosevelt -->