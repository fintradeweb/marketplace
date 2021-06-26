@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h5>Welcome Admin!</h5></br>
      <div class="list-group">
        <a href="/home" class="list-group-item list-group-item-action active">
          Home
        </a>
        <a href="/clients" class="list-group-item list-group-item-action">Clients</a>
      </div> 
    </div>
  </div>
</div>
@endsection
