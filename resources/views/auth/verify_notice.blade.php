@extends('components.layout.layout')

@section('children')
  <div class="bg-white p-8 rounded-lg shadow-lg text-center">
    <p class="mb-4 text-gray-600">Please check your email for a verification link. If you did not receive the email,</p>
    <form action="{{ route('verification.send') }}" method="GET">
      <button 
        type="submit" 
        class="px-4 py-2 disabled:bg-gray-400 bg-[#41af27] text-white rounded hover:bg-[#41af27]/80 transition duration-300"
      >
        Resend Email
      </button>
    </form>
  </div>
@endsection
<!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->