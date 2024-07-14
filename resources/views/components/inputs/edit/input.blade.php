<div>
  <label class="form_label">{{ $label }}</label>
  <input
    name="{{ $name }}"
    type="{{ $type }}"
    value="{{ old($name) ?? $$name }}"
    class="form_input @error($name) border-red-500 @enderror"
    placeholder="{{ $placeholder }}"
    @required(true)
  />
  @error($name)
    @foreach ($errors->get($name) as $error)
      <span class="text-red-700 text-sm block">{{ $error }}</span>
    @endforeach
  @enderror
</div>
{{-- <div>
    <!-- Be present above all else. - Naval Ravikant -->
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
</div> --}}