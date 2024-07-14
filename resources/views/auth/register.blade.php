@extends('components.layout.layout')

@section('children')
  <x-forms.auth_form action="{{ route('register') }}" method="POST" />
@endsection