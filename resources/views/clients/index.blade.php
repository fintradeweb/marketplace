@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="row col-md-10 p-4">
        <div class="col-md-6"><h5>List of Clients</h5></div>
        <div class="col-md-6" align="right">
          <a type="button" class="btn btn-primary" href="/clients/create">New Client</a>
        </div>
      </div>
      <div class="col-md-10">
        <clients-index-component :clients="{{json_encode($clients)}}"></client-index-component> 
      </div>
    </div>
  </div>  
@endsection