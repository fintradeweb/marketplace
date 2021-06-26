@extends('layouts.app')

@section('content')
  {{print_r($clients)}}
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <clients-index-component></client-index-component> 
      </div>
    </div>
  </div>  
@endsection
