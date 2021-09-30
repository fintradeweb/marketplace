@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-12 p-4">
      <div class="col-md-6"><h5>Consult Credit User of - {{$business->company_name}}</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/users"class="btn btn-primary">Return</a>
      </div>
    </div> 
   
    <div class="row col-md-12 col-lg-12 col-sm-12 p-4">
      <div class="col-md-4 text-center">   
        <a href="/users/" data-toggle="tooltip" data-placement="top" title="Approve Credit">
          <i class="fa fa-check-square-o" aria-hidden="true" style="font-size:25px;"></i>&nbsp;Approve Credit
        </a>      
      </div>
      <div class="col-md-4 text-center">  
        <a href="/users/" data-toggle="tooltip" data-placement="top" title="Deny Credit">
          <i class="fa fa-window-close" aria-hidden="true" style="font-size:25px;"></i>&nbsp;Deny Credit
        </a>  
      </div>    
      <div class="col-md-4 text-center">  
        <a href="/users/" data-toggle="tooltip" data-placement="top" title="Ask more information">
          <i class="fa fa-question" aria-hidden="true" style="font-size:25px;"></i>&nbsp;Ask more information
        </a>
      </div>
    </div>
   
    <div class="row col-md-12 col-lg-12 col-sm-12">
      <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="pills-business-tab" data-toggle="pill" href="#pills-business" role="tab" aria-controls="pills-business" aria-selected="true">Business Information</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-management-tab" data-toggle="pill" href="#pills-management" role="tab" aria-controls="pills-management" aria-selected="false">Management Information</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-financial-tab" data-toggle="pill" href="#pills-financial" role="tab" aria-controls="pills-financial" aria-selected="false">Financial Information</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-bank-tab" data-toggle="pill" href="#pills-bank" role="tab" aria-controls="pills-bank" aria-selected="false">Bank Information</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="pills-certification-tab" data-toggle="pill" href="#pills-certification" role="tab" aria-controls="pills-certification" aria-selected="false">Certification Information</a>
        </li>
      </ul>
    </div>
    
    <div class="tab-content col-md-12 col-lg-12 col-sm-12" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-business" role="tabpanel" aria-labelledby="pills-business-tab">
        @if (!empty($business))
          <div class="card">             
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <span class="card-title"><b>Company name:</b></span>&nbsp;
                  <span class="card-text">{{$business->company_name}}</span>
                </li>
                <li class="list-group-item">
                  <span class="card-title"><b>Company date:</b></span>&nbsp;
                  <span class="card-text">{{@substr($business->date_company,0,10)}}</span>  
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
        @else 
          <div class="alert alert-warning" role="alert">There is not information</div>
        @endif
      </div>
      <div class="tab-pane fade" id="pills-management" role="tabpanel" aria-labelledby="pills-management-tab">
        @if (!empty($management))
          <div class="card">             
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
        @else          
          <div class="alert alert-warning" role="alert">There is not information</div>          
        @endif
      </div>
      <div class="tab-pane fade" id="pills-financial" role="tabpanel" aria-labelledby="pills-financial-tab">
        @if (!empty($financial))
          <div class="card">             
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
        @else
          <div class="alert alert-warning" role="alert">There is not information</div>  
        @endif
      </div>
      <div class="tab-pane fade" id="pills-bank" role="tabpanel" aria-labelledby="pills-bank-tab">
        @if (!empty($bank))
          <div class="card">             
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
                  <span class="card-title"><b>ABA/Routing:</b></span>
                  <span class="card-text">{{$bank->aba_routing}}</span>  
                </li>          
                <li class="list-group-item">
                  <span class="card-title"><b>Bank Address:</b></span>
                  <span class="card-text">{{$bank->bank_adress}}</span>  
                </li> 
                <li class="list-group-item">
                  <span class="card-title"><b>Telephone:</b></span>
                  <span class="card-text">{{$bank->telephone}}</span>  
                </li> 
                <li class="list-group-item">
                  <span class="card-title"><b>Adress:</b></span>
                  <span class="card-text">****Falta el address****</span>  
                </li> 
                <li class="list-group-item">
                  <span class="card-title"><b>Account Officer:</b></span>
                  <span class="card-text">{{$bank->account_officer}}</span>  
                </li>                 
              </ul>
            </div>               
          </div>
        @else
          <div class="alert alert-warning" role="alert">There is not information</div>  
        @endif
      </div>
      <div class="tab-pane fade" id="pills-certification" role="tabpanel" aria-labelledby="pills-certification-tab">
        @if (!empty($certification))
          <div class="card">             
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <span class="card-title"><b>Signer Name:</b></span>&nbsp;
                  <span class="card-text">{{$certification->name}}</span>
                </li>
                <li class="list-group-item">
                  <span class="card-title"><b>Title:</b></span>&nbsp;
                  <span class="card-text">{{$certification->title}}</span>  
                </li>
                <li class="list-group-item">
                  <span class="card-title"><b>Status:</b></span>&nbsp;
                  <span class="card-text">
                  @if (trim($certification->approved_agreed) == 'checked')
                    Approved
                  @else
                    Not approved
                  @endif
                  </span> 
                </li>                               
              </ul>
            </div>               
          </div>
        @else 
          <div class="alert alert-warning" role="alert">There is not information</div> 
        @endif
      </div>
    </div>    

  </div>
</div>  
@endsection