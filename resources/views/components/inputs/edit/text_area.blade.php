<div>
  <label class="form_label">{{ $label }}</label>
  <textarea 
    name="{{ $name }}"
    cols="30"
    rows="10"
    placeholder="{{ $placeholder }}"
    class="form_input @error($name) border-red-500 @enderror"
    @required(true)
  >{{ old($name) ?? $$name }}</textarea>
  @error($name)
    @foreach ($errors->get($name) as $error)
      <span class="text-red-700 text-sm block">{{ $error }}</span>
    @endforeach
  @enderror
</div>
{{-- <div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div> --}}