@extends('components.layout.error_layout')
@section('children')
  <x-errors.message_with_code :statusCode="$exception->getStatusCode()" />
@endsection
<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
