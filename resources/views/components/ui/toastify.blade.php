@php
  $message = session('message');
  $status = session('status') ?? true;
@endphp

<div id="toast" class="fixed flex top-6 left-1/2 -translate-x-1/2 -translate-y-[200px] z-50 custom_transition">
  <div 
    class="border-t-4 px-10 py-4 
    {{ $status ? 
      'bg-green-100 border-green-500 text-green-700' 
      : 
      'bg-red-100 border-red-500 text-red-700' }}" 
    role="alert"
  >
    <p class="font-bold capitalize">{{ $status ? "success" : "error" }}</p>
    <p >{{ $message }}</p>
  </div>
</div>