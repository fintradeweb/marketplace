@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>Consult Client</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/clients"class="btn btn-primary">Return</a>
      </div>
    </div> 
    <div class="col-md-10">                 
      <div class="card">      
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h5 class="card-title">Name:</h5>
              <p class="card-text">{{$client->name}}</p>  
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Email:</h5>
              <p class="card-text">{{$client->email}}</p>  
            </li>          
          </ul>                
        </div>               
      </div>
  </div>
</div>  
@endsection