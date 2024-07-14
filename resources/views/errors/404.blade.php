@extends('components.layout.error_layout')
@section('children')
  <x-errors.message_with_code :statusCode="$exception->getStatusCode()" />
@endsection
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
