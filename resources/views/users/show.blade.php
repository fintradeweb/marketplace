@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>Consult Credit User</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/users"class="btn btn-primary">Return</a>
      </div>
    </div> 
    <div class="col-md-6">                 
      <div class="card"> 
        <div class="card-header">Business Information</div>    
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h6 class="card-title">Name:</h6>
              <p class="card-text">{{$user->name}}</p>  
            </li>
            <li class="list-group-item">
              <h6 class="card-title">Email:</h6>
              <p class="card-text">{{$user->email}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">Created date:</h6>
              <p class="card-text">{{$user->created_at}}</p>  
            </li>          
          </ul>
        </div>               
      </div>
    </div>
    <div class="col-md-6">                 
      <div class="card"> 
        <div class="card-header">Management Information</div>    
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h6 class="card-title">Company date:</h6>
              <p class="card-text">{{$user->date_company}}</p>  
            </li>
            <li class="list-group-item">
              <h6 class="card-title">Type business:</h6>
              <p class="card-text">{{$user->type_business}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">Contact name:</h6>
              <p class="card-text">{{$user->contact_name}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">Zip code:</h6>
              <p class="card-text">{{$user->zip}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">Phone number:</h6>
              <p class="card-text">{{$user->phone}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">President name:</h6>
              <p class="card-text">{{$user->president_name}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">Address:</h6>
              <p class="card-text">{{$user->address}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">Ruc or tax:</h6>
              <p class="card-text">{{$user->ruc_tax}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">Website:</h6>
              <p class="card-text">{{$user->website}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">Secretary name:</h6>
              <p class="card-text">{{$user->secretary_name}}</p>  
            </li>          
            <li class="list-group-item">
              <h6 class="card-title">Dba:</h6>
              <p class="card-text">{{$user->cell_phone}}</p>  
            </li>          
          </ul>
        </div>               
      </div>
    </div>
  </div>
</div>  
@endsection