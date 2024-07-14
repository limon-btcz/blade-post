@php
  $msg = "Relax, You trying to attemps too many request!";
@endphp
@extends('components.layout.error_layout')
@section('children')
  <div class="h-screen flex justify-center items-center flex-col">
    <div class="w-20 h-20">
      <img src="{{ asset('logo.png') }}" alt="" />
    </div>
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
      <p class="mb-4 text-gray-600 text-3xl">{{ $msg }}</p>
      <div class="mt-[26px]">
        <a href="/" class="custom_transition px-11 py-[14px] bg-[#41af27] hover:bg-[#41af27]/80 text-lg font-semibold rounded-[50px] capitalize text-white">Back to home</a>
      </div>
    </div>
  </div>
@endsection
<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
