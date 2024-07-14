<div>
  <label class="form_label">{{ $label }}</label>
  <input
    name="{{ $name }}"
    type="file"
    class="form_input @error($name) border-red-500 @enderror"
    accept="image/png, image/jpg, image/jpeg"
  />
  @error($name)
    @foreach ($errors->get($name) as $error)
      <span class="text-red-700 text-sm block">{{ $error }}</span>
    @endforeach
  @enderror
</div>