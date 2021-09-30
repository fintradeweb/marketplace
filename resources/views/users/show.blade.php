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
      <div class="col-md-6 col-lg-6 col-sm-12 p-3">                 
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
      <div class="col-md-6 col-lg-6 col-sm-12 p-3">                 
        <div class="card"> 
          <div class="card-header">Management Information</div>    
          <div class="card-body">
            @foreach($management as $key=>$mng)
              <ul class="list-group list-group-flush">
                <li class="list-group-item" style="text-align: center;background-color: #ced9d9;">
                  <span class="card-title"><b>#{{$key + 1}}</b></span>&nbsp;
                </li>
                <li class="list-group-item">
                  <span class="card-title"><b>Name:</b></span>&nbsp;
                  <span class="card-text">{{$mng->name}}</span>
                </li>
                <li class="list-group-item">
                  <span class="card-title"><b>Id Number:</b></span>&nbsp;
                  <span class="card-text">{{$mng->idno}}</span>  
                </li>
                <li class="list-group-item">
                  <span class="card-title"><b>Percentage:</b></span>&nbsp;
                  <span class="card-text">{{$mng->percentage}}%</span>  
                </li>          
                <li class="list-group-item">
                  <span class="card-title"><b>Position:</b></span>
                  <span class="card-text">{{$mng->position}}</span>  
                </li>          
                <li class="list-group-item">
                  <span class="card-title"><b>Birthdate:</b></span>
                  <span class="card-text">{{$mng->birthdate}}</span>  
                </li>           
              </ul>
            @endforeach
          </div>               
        </div>
      </div>
    @endif

    @if (!empty($financial))
      <div class="col-md-6 col-lg-6 col-sm-12 p-3">                 
        <div class="card"> 
          <div class="card-header">Financial Information</div>    
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <span class="card-title"><b>Avg monthly sales:</b></span>&nbsp;
                <span class="card-text">{{$financial->avg_montky_sales}}</span>
              </li>
              <li class="list-group-item">
                <span class="card-title"><b>In how many clients?:</b></span>&nbsp;
                <span class="card-text">{{$financial->ams_how_clients}}</span>  
              </li>
              <li class="list-group-item">
                <span class="card-title"><b>Has applicant or any entity in which applicant is an owner / partner owe any taxes that are past due?:</b></span>&nbsp;
                <span class="card-text">@if ($financial->has_applicant == 'checked') Yes @else No @endif</span> 
              </li>          
              <li class="list-group-item">
                <span class="card-title"><b>Estimated monthly financing volume:</b></span>
                <span class="card-text">{{$financial->estimated_montly_financing}}</span>  
              </li>          
              <li class="list-group-item">
                <span class="card-title"><b>Number of clients to finance?:</b></span>
                <span class="card-text">{{$financial->emf_number_clients}}</span>  
              </li> 
              <li class="list-group-item">
                <span class="card-title"><b>What type of documents are you looking to finance (PO- Invoice)?:</b></span>
                <span class="card-text">
                  @if ($financial->po_finance == 'checked' && $financial->in_finance == 'checked')
                    Both
                  @elseif ($financial->po_finance == 'checked')
                    PO
                  @elseif ($financial->in_finance == 'checked')
                    Invoice
                  @endif
                </span>  
              </li> 
              <li class="list-group-item">
                <span class="card-title"><b>Has applicant or any entity in which applicant is an owner / partner has any lawsuits pending?:</b></span>
                <span class="card-text">@if ($financial->lawsuits_pending == 'checked') Yes @else No @endif</span>  
              </li> 
              <li class="list-group-item">
                <span class="card-title"><b>Have you ever factored your receivables?:</b></span>
                <span class="card-text">@if ($financial->receivable_finance == 'checked') Yes @else No @endif</span>  
              </li> 
              <li class="list-group-item">
                <span class="card-title"><b>If yes, when/with whom?:</b></span>
                <span class="card-text">{{$financial->rf_when_with_whom}}</span>  
              </li> 
              <li class="list-group-item">
                <span class="card-title"><b>Do you have a Credit Insurance policy?:</b></span>
                <span class="card-text">@if ($financial->credit_insurance_policy == 'checked') Yes @else No @endif</span>  
              </li>
              <li class="list-group-item">
                <span class="card-title"><b>If yes, when/with whom?:</b></span>
                <span class="card-text">{{$financial->cip_when_with_whom}}</span>  
              </li>
              <li class="list-group-item">
                <span class="card-title"><b>Has applicant or any entity in which applicant is an owner / partner ever declared bankruptcy?:</b></span>
                <span class="card-text">@if ($financial->declared_bank_ruptcy == 'checked') Yes @else No @endif</span>  
              </li>           
            </ul>
          </div>               
        </div>
      </div>
    @endif
  </div>
</div>  
@endsection