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
   
    
    <div class="col-md-6">                 
      <div class="card"> 
        <div class="card-header">Business Information</div>    
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <span class="card-title"><b>Company name:</b></span>&nbsp;
              <span class="card-text">{{$user->company_name}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Company date:</b></span>&nbsp;
              <span class="card-text">{{$user->date_company}}</span>  
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Type business:</b></span>&nbsp;
              <span class="card-text">{{$user->type_business}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Contact name:</b></span>
              <span class="card-text">{{$user->contact_name}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Zip code:</b></span>
              <span class="card-text">{{$user->zip}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>President name:</b></span>
              <span class="card-text">{{$user->president_name}}</span>  
            </li>  
            <li class="list-group-item">
              <span class="card-title"><b>Address:</b></span>
              <span class="card-text">{{$user->address}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Ruc or tax:</b></span>
              <span class="card-text">{{$user->ruc_tax}}</span>  
            </li> 
            <li class="list-group-item">
              <span class="card-title"><b>Website:</b></span>
              <span class="card-text">{{$user->website}}</span>  
            </li>          
            <li class="list-group-item">
              <span class="card-title"><b>Secretary name:</b></span>
              <span class="card-text">{{$user->secretary_name}}</span>  
            </li>                         
            <li class="list-group-item">
              <span class="card-title"><b>Dba:</b></span>
              <span class="card-text">{{$user->dba}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Cellphone number:</b></span>
              <span class="card-text">{{$user->cell_phone}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Country:</b></span>
              <span class="card-text">{{$user->country}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>City:</b></span>
              <span class="card-text">{{$user->city}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>State:</b></span>
              <span class="card-text">{{$user->state}}</span>  
            </li>   
            <li class="list-group-item">
              <span class="card-title"><b>Phone:</b></span>
              <span class="card-text">{{$user->phone}}</span>  
            </li>     
            <li class="list-group-item">
              <span class="card-title"><b>Client:</b></span>
              <span class="card-text">{{$user->client_name}}</span>  
            </li>      
          </ul>
        </div>               
      </div>
    </div>

    <div class="col-md-6">                 
      <div class="card"> 
        <div class="card-header">Financial Information</div>    
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <span class="card-title"><b>Average monthly sales:</b></span>&nbsp;
              <span class="card-text">{{$financial->avg_montky_sales}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>In how many clients?:</b></span>&nbsp;
              <span class="card-text">{{$financial->ams_how_clients}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Has applicant or any entity in which applicant is an owner / partner owe any taxes that are past due?:</b></span>&nbsp;
              <span class="card-text">{{$financial->has_applicant}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Estimated monthly financing volume:</b></span>&nbsp;
              <span class="card-text">{{$financial->estimated_montly_financing}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Number of clients to finance?:</b></span>&nbsp;
              <span class="card-text">{{$financial->emf_number_clients}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>What type of documents are you looking to finance?:</b></span>&nbsp;
              <span class="card-text">PO: {{$financial->po_finance}} Invoice: {{$financial->in_finance}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Has applicant or any entity in which applicant is an owner / partner has any lawsuits pending?:</b></span>&nbsp;
              <span class="card-text">{{$financial->lawsuits_pending}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Have you ever factored your receivables?:</b></span>&nbsp;
              <span class="card-text">{{$financial->receivable_finance}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>If yes, when/with whom?:</b></span>&nbsp;
              <span class="card-text">{{$financial->rf_when_with_whom}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Do you have a Credit Insurance policy?:</b></span>&nbsp;
              <span class="card-text">{{$financial->credit_insurance_policy}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>If yes, when/with whom?:</b></span>&nbsp;
              <span class="card-text">{{$financial->cip_when_with_whom}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Has applicant or any entity in which applicant is an owner / partner ever declared bankruptcy?:</b></span>&nbsp;
              <span class="card-text">{{$financial->declared_bank_ruptcy}}</span>
            </li>
          </ul>
        </div>               
      </div>
    </div>
    

    
    <div class="col-md-6">                 
      <div class="card"> 
        <div class="card-header">Bank Information</div>    
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <span class="card-title"><b>Bank Name:</b></span>&nbsp;
              <span class="card-text">{{$bank->bank_name}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Account Name SWIFT:</b></span>&nbsp;
              <span class="card-text">{{$bank->account_same_swift}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Account Number:</b></span>&nbsp;
              <span class="card-text">{{$bank->account_number}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>ABA/Routing #:</b></span>&nbsp;
              <span class="card-text">{{$bank->aba_routing}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Bank Address:</b></span>&nbsp;
              <span class="card-text">{{$bank->bank_adress}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Telephone:</b></span>&nbsp;
              <span class="card-text">{{$bank->telephone}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Account Officer:</b></span>&nbsp;
              <span class="card-text">{{$bank->account_officer}}</span>
            </li>
          </ul>
        </div>               
      </div>
    </div>

    <div class="col-md-6"> 
      <div class="card"> 
        <div class="card-header">Certification Authorization</div>    
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <span class="card-title"><b>Approved and Agreed:</b></span>&nbsp;
              <span class="card-text">{{$certification->approved_agreed}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Name:</b></span>&nbsp;
              <span class="card-text">{{$certification->name}}</span>
            </li>
            <li class="list-group-item">
              <span class="card-title"><b>Title:</b></span>&nbsp;
              <span class="card-text">{{$certification->title}}</span>
            </li>
          </ul>
        </div>               
      </div>
    </div>

  </div>
</div>  
@endsection