@extends('layouts.app')

@section('content')
  {{print_r($clients)}}
  <clients-index-component></client-index-component> 
@endsection
