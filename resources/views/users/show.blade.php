@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-12 p-4">
      <div class="col-md-6"><h5>Consult Credit User</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/users"class="btn btn-primary">Return</a>
      </div>
    </div> 
   
    @if (!empty($business))
    <div class="col-md-6 col-lg-6 col-sm-12">                 
      <div class="card"> 
        <div class="card-header">Business Information</div>    
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <span class="card-title"><b>Company name:</b></span>&nbsp;
              <span class="card-text">{{$business->company_name}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Company date:</b></span>&nbsp;
              <span class="card-text">{{$business->date_company}}</span>  
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Type business:</b></span>&nbsp;
              <span class="card-text">{{$business->type_business}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Contact name:</b></span>
              <span class="card-text">{{$business->contact_name}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Zip code:</b></span>
              <span class="card-text">{{$business->zip}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>President name:</b></span>
              <span class="card-text">{{$business->president_name}}</span>  
            </li>  
            <li class="list-group-item">
              <span class="card-title"><b>Address:</b></span>
              <span class="card-text">{{$business->address}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Ruc or tax:</b></span>
              <span class="card-text">{{$business->ruc_tax}}</span>  
            </li> 
            <li class="list-group-item">
              <span class="card-title"><b>Website:</b></span>
              <span class="card-text">{{$business->website}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Secretary name:</b></span>
              <span class="card-text">{{$business->secretary_name}}</span>  
            </li>                         
            <li class="list-group-item">
              <span class="card-title"><b>Dba:</b></span>
              <span class="card-text">{{$business->dba}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Cellphone number:</b></span>
              <span class="card-text">{{$business->cell_phone}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Country:</b></span>
              <span class="card-text">{{$business->country}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>City:</b></span>
              <span class="card-text">{{$business->city}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>State:</b></span>
              <span class="card-text">{{$business->state}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Phone:</b></span>
              <span class="card-text">{{$business->phone}}</span>  
            </li>     
            <li class="list-group-item">
              <span class="card-title"><b>Client:</b></span>
              <span class="card-text">{{$business->client_name}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Type:</b></span>
              @if ($business->is_buyer == "true")
                <span class="card-text">Buyer</span>  
              @else
                <span class="card-text">Seller</span>  
              @endif
            </li>        
          </ul>
        </div>               
      </div>
    </div>
    @endif

    @if (!empty($management))
    <div class="col-md-6 col-lg-6 col-sm-12">                 
      <div class="card"> 
        <div class="card-header">Management Information</div>    
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <span class="card-title"><b>Company name:</b></span>&nbsp;
              <span class="card-text">{{$business->company_name}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Company date:</b></span>&nbsp;
              <span class="card-text">{{$business->date_company}}</span>  
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Type business:</b></span>&nbsp;
              <span class="card-text">{{$business->type_business}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Contact name:</b></span>
              <span class="card-text">{{$business->contact_name}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Zip code:</b></span>
              <span class="card-text">{{$business->zip}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>President name:</b></span>
              <span class="card-text">{{$business->president_name}}</span>  
            </li>  
            <li class="list-group-item">
              <span class="card-title"><b>Address:</b></span>
              <span class="card-text">{{$business->address}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Ruc or tax:</b></span>
              <span class="card-text">{{$business->ruc_tax}}</span>  
            </li> 
            <li class="list-group-item">
              <span class="card-title"><b>Website:</b></span>
              <span class="card-text">{{$business->website}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Secretary name:</b></span>
              <span class="card-text">{{$business->secretary_name}}</span>  
            </li>                         
            <li class="list-group-item">
              <span class="card-title"><b>Dba:</b></span>
              <span class="card-text">{{$business->dba}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Cellphone number:</b></span>
              <span class="card-text">{{$business->cell_phone}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Country:</b></span>
              <span class="card-text">{{$business->country}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>City:</b></span>
              <span class="card-text">{{$business->city}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>State:</b></span>
              <span class="card-text">{{$business->state}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Phone:</b></span>
              <span class="card-text">{{$business->phone}}</span>  
            </li>     
            <li class="list-group-item">
              <span class="card-title"><b>Client:</b></span>
              <span class="card-text">{{$business->client_name}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Type:</b></span>
              @if ($business->is_buyer == "true")
                <span class="card-text">Buyer</span>  
              @else
                <span class="card-text">Seller</span>  
              @endif
            </li>        
          </ul>
        </div>               
      </div>
    </div>
    @endif

  </div>
</div>  
@endsection