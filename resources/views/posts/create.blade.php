@extends('components.layout.layout')

@section('children')
  <x-forms.form action="{{ route('posts.store') }}" method="POST" />
@endsection
<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
