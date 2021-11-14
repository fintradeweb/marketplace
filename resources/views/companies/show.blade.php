@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>Consult Company</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/companies"class="btn btn-primary">Return</a>
      </div>
    </div> 
    <div class="col-md-10">                 
      <div class="card">      
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h5 class="card-title">Name:</h5>
              <p class="card-text">{{$company->name}}</p>  
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Description:</h5>
              <p class="card-text">{{$company->description}}</p>  
            </li>   
            <li class="list-group-item">
              <h5 class="card-title">Address:</h5>
              <p class="card-text">{{$company->address}}</p>  
            </li>  
            <li class="list-group-item">
              <h5 class="card-title">Status:</h5>
              <p class="card-text">@if ($company->active == "checked") Active @else Inactive @endif</p>  
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Date Created:</h5>
              <p class="card-text">{{$company->created_at}}</p>  
            </li>          
          </ul>                
        </div>               
      </div>
  </div>
</div>  
@endsection