@extends('components.layout.layout')

@section('children')
<div class="max-w-2xl mx-auto">
  <form class="space-y-[18px]" action="{{ route('posts.update', ["post" => $post->slug]) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="rounded-md shadow-sm space-y-[17px]">
      <x-inputs.edit.input :title="$post->title" name="title" type="text" label="post title" placeholder="post title" />
      <x-inputs.edit.text_area :content="$post->content" name="content" label="post description" placeholder="post description" />
      <x-inputs.file_input name="image" label="Post image" />
      {{-- old picture --}}
      @if($post->image)
      <div class="w-20 h-20">
        <img src="{{ config('app.url') . "/" . $post->image }}" alt="" >
      </div>
      @endif
    </div>
    <x-buttons.auth_button />
  </form>
</div>
@endsection