@extends('components.layout.layout')

@section('children')
  <x-forms.auth_form action="{{ route('password.reset') }}" method="POST" :token="$token" />
@endsection
<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
