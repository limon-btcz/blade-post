@extends('components.layout.layout')

@section('children')
<div class="grid gap-6 py-6 grid-cols-12">
  @forelse ($posts as $post)
  <x-post :post="$post" />
  @empty
  <div class="col-span-12">
    <p class="text-gray-700 text-xl">
      Recently no posts available. You can create a post - 
      <a 
        href="{{ route('posts.create') }}"
        class="capitalize text-[#41af27]"
      >create post</a>
    </p>
  </div>
  @endforelse
  <div class="col-span-12">{{ $posts->links() }}</div>
</div>
@endsection
<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
