@extends('components.layout.layout')

@section('children')
  <x-forms.auth_form action="{{ route('password.email') }}" method="POST" />
@endsection
<!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
