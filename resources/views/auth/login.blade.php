@extends('components.layout.layout')

@section('children')
  <x-forms.auth_form action="{{ route('login') }}" method="POST" />
@endsection