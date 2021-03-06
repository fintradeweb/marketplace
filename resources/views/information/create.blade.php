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
    <div class="row col-md-12 p-4 text-center">
      <div class="col-md-12"><h5>Business Information</h5></div>
      <div class="col-md-12">Please confirm your information, then click in Save button to continue</div>        
    </div>
    <div class="col-md-12 p-4 text-justify">
      <form action="{{ route('information.create') }}" method="POST" id="frm_createinformation">
        @csrf  
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="name" id="name" class="form-control" value="{{ $name }}" placeholder="">              
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Email: <span class="text-danger">(*)</span></strong>
              <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email }}" required>
              <span class="font-italic text-info">Ex: example@marketplace.com</span>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Tax Id: <span class="text-danger">(*)</span></strong>
              <input type="text" name="ruc_tax" id="ruc_tax" class="form-control @error('ruc_tax') is-invalid @enderror" value="{{ $ruc_tax }}" placeholder="">
              @error('ruc_tax')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="row">          
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Date Company Was Established: <span class="text-danger">(*)</span></strong>
              <input type="text" name="date_company" id="date_company" class="form-control @error('ruc_tax') is-invalid @enderror" value="{{ $date_company }}" placeholder="">
              <span class="font-italic text-info">Ex: 2021-08-17</span>
              @error('date_company')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Contact Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="contact_name" id="contact_name" class="form-control @error('contact_name') is-invalid @enderror" value="{{ $contact_name }}" placeholder="">
              @error('contact_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>            
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>President Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="president_name" id="president_name" class="form-control @error('president_name') is-invalid @enderror" value="{{ $president_name }}" placeholder="">
              @error('president_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>        
        <div class="row">    
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Type Of Bussiness: <span class="text-danger">(*)</span></strong>
              <input type="text" name="type_business" id="type_business" class="form-control @error('type_business') is-invalid @enderror" value="{{ $type_business }}" placeholder="">
              @error('type_business')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Phone: <span class="text-danger">(*)</span></strong>
              <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $phone }}" placeholder="">
              @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>  
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Country: <span class="text-danger">(*)</span></strong>
              <input type="text" name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror" value="{{ $country_id }}" placeholder="">
              @error('country_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>        
        </div>        
        <div class="row">                        
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>State: <span class="text-danger">(*)</span></strong>
              <input type="text" name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror" value="{{ $state_id }}" placeholder="">
              @error('state_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">            
            <div class="form-group">
              <strong>City: <span class="text-danger">(*)</span></strong>
              <input type="text" name="city_id" id="city_id" class="form-control @error('city_id') is-invalid @enderror" value="{{ $city_id }}" placeholder="">
              @error('city_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div> 
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Zip Code: <span class="text-danger">(*)</span></strong>
              <input type="text" name="zip" id="zip" class="form-control @error('zip') is-invalid @enderror" value="{{ $zip }}" placeholder="">
              @error('zip')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="row">                        
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Address: <span class="text-danger">(*)</span></strong>
              <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ $address }}" placeholder="">
              @error('address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Cellphone:</strong>
              <input type="text" name="cell_phone" id="cell_phone" class="form-control @error('cell_phone') is-invalid @enderror" value="{{ $cell_phone }}" placeholder="">
              @error('cell_phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Website:</strong>
              <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ $website }}" placeholder="">
              <span class="font-italic text-info">Ex: http://www.marketplace.com</span>
              @error('website')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>                        
        <div class="row">                                  
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Dba:</strong>
              <input type="text" name="dba" id="dba" class="form-control @error('dba') is-invalid @enderror" value="{{ $dba }}" placeholder="">
              @error('dba')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>         
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Secretary Name:</strong>
              <input type="text" name="secretary_name" id="secretary_name" class="form-control @error('secretary_name') is-invalid @enderror" value="{{ $secretary_name }}" placeholder="">
              @error('secretary_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div> 
        </div>
        <div class="row">                                      
          <input type="hidden" id="token" name="token" value="{{ $token }}">
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary" id="btn_save">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

<script src="{{ asset('js/information.js') }}" defer=""></script>