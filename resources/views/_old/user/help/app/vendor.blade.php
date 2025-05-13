@extends('help.app.layout')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('src/css/help.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('src/fonts/elegant_font/css/style.css')}}"/>
@endpush
@section('title')Help | Expiring Soon @endsection
@section('main')

@include('help.content.vendors')
  
@endsection
@push('scripts')

@endpush
