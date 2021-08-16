@extends('layouts.app')
@section('content')

@if ($errors->any())
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-8 col-sm-12">
      <div class="alert alert-danger" role="alert">        
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>  
@endif
   
<div class="container">    
  <div class="row justify-content-center"> 
    <div class="row col-md-10 p-4 text-center">
      <div class="col-md-12"><h5>Business Information</h5></div>
      <div class="col-md-12">Please complete your information, then click in Save button to continue</div>        
    </div> 
    <div class="col-md-10 p-4 text-justify">
      <form action="{{ route('information.edit') }}" method="POST" id="frm_editinformation">
        @csrf
        @method('PUT')    
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="">
              <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
              <input type="hidden" name="business_id" id="business_id" value="{{ $business->id }}">
              <input type="hidden" name="client_id" id="client_id" value="{{ $client->id }}">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Email: <span class="text-danger">(*)</span></strong>
              <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="">
              <span class="font-italic text-info">Ex: example@marketplace.com</span>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Tax Id: <span class="text-danger">(*)</span></strong>
              <input type="text" name="taxid" id="taxid" class="form-control" value="{{ $business->ruc_tax }}" placeholder="">
            </div>
          </div>
        </div>
        <div class="row">          
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Date Company Was Established: <span class="text-danger">(*)</span></strong>
              <input type="text" name="datecompany" id="datecompany" class="form-control" value="{{ $business->date_company }}" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Contact Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="contactname" id="contactname" class="form-control" value="{{ $business->contact_name }}" placeholder="">
            </div>
          </div>            
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>President Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="presidentname" id="presidentname" class="form-control" value="{{ $business->president_name }}" placeholder="">
            </div>
          </div>
        </div>        
        <div class="row">    
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Type Of Bussiness: <span class="text-danger">(*)</span></strong>
              <input type="text" name="typeofbusiness" id="typeofbusiness" class="form-control" value="{{ $business->type_business }}" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Phone: <span class="text-danger">(*)</span></strong>
              <input type="text" name="phone" id="phone" class="form-control" value="{{ $business->phone }}" placeholder="">
            </div>
          </div>  
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Country: <span class="text-danger">(*)</span></strong>
              <input type="text" name="country" id="country" class="form-control" value="{{ $business->country_id }}" placeholder="">
            </div>
          </div>        
        </div>        
        <div class="row">                        
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>City: <span class="text-danger">(*)</span></strong>
              <input type="text" name="city" id="city" class="form-control" value="{{ $business->city_id }}" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>State: <span class="text-danger">(*)</span></strong>
              <input type="text" name="state" id="state" class="form-control" value="{{ $business->state_id }}" placeholder="">
            </div>
          </div> 
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Zip Code: <span class="text-danger">(*)</span></strong>
              <input type="text" name="zipcode" id="zipcode" class="form-control" value="{{ $business->zip }}" placeholder="">
            </div>
          </div>
        </div>
        <div class="row">                        
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Address: <span class="text-danger">(*)</span></strong>
              <input type="text" name="address" id="address" class="form-control" value="{{ $business->address }}" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Cellphone:</strong>
              <input type="text" name="cellphone" id="cellphone" class="form-control" value="{{ $business->cell_phone }}" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Website:</strong>
              <input type="text" name="website" id="website" class="form-control" value="{{ $business->website }}" placeholder="">
              <span class="font-italic text-info">Ex: http://www.marketplace.com</span>
            </div>
          </div>
        </div>                        
        <div class="row">                                  
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Dba:</strong>
              <input type="text" name="dba" id="dba" class="form-control" value="{{ $business->dba }}" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Secretary Name:</strong>
              <input type="text" name="secretaryname" id="secretaryname" class="form-control" value="{{ $business->secretary_name }}" placeholder="">
            </div>
          </div>           
        </div>
        <div class="row">                                      
          <input type="hidden" id="token" name="token" value="{{ $token }}">
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="button" class="btn btn-primary" id="btn_edit">Save</button>
          </div>
        </div>
      </form>
    </div>  
  </div>
</div>
@endsection

<script src="{{ asset('js/information.js') }}" defer=""></script>