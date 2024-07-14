<div class="max-w-2xl mx-auto">
  <form class="space-y-[18px]" action="{{ $action }}" method="{{ $method }}" enctype="multipart/form-data" >
    @csrf
    @method($method)
    <div class="rounded-md shadow-sm space-y-[17px]">
      <x-inputs.input name="title" type="text" label="post title" placeholder="post title" />
      <x-inputs.text_area name="content" label="post description" placeholder="post description" />
      <x-inputs.file_input name="image" label="Post image" />
    </div>
    <x-buttons.auth_button />
  </form>
</div>