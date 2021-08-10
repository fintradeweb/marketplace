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
      <div class="col-md-12"><h5>User information</h5></div>
      <div class="col-md-12">Please complete your information, then click in Save button to continue</div>        
    </div> 
    <div class="col-md-10 p-4 text-justify">
      <form action="business/edit" method="POST" id="frm_editbusiness">
        @csrf
        @method('PUT')    
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="name" id="name" class="form-control" value="" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Email: <span class="text-danger">(*)</span></strong>
              <input type="text" name="email" id="email" class="form-control" value="" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Tax Id: <span class="text-danger">(*)</span></strong>
              <input type="text" name="taxid" id="taxid" class="form-control" value="" placeholder="">
            </div>
          </div>
        </div>
        <div class="row">          
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Date Company Was Established: <span class="text-danger">(*)</span></strong>
              <input type="text" name="datecompany" id="datecompany" class="form-control" value="" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Contact Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="contactname" id="contactname" class="form-control" value="" placeholder="">
            </div>
          </div>            
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>President Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="president" id="president" class="form-control" value="" placeholder="">
            </div>
          </div>
        </div>        
        <div class="row">    
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Type Of Bussiness: <span class="text-danger">(*)</span></strong>
              <input type="text" name="typebussiness" id="typebussiness" class="form-control" value="" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Phone: <span class="text-danger">(*)</span></strong>
              <input type="text" name="phone" id="phone" class="form-control" value="" placeholder="">
            </div>
          </div>  
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Country: <span class="text-danger">(*)</span></strong>
              <input type="text" name="country" id="country" class="form-control" value="" placeholder="">
            </div>
          </div>        
        </div>        
        <div class="row">                        
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>City: <span class="text-danger">(*)</span></strong>
              <input type="text" name="city" id="city" class="form-control" value="" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>State: <span class="text-danger">(*)</span></strong>
              <input type="text" name="state" id="state" class="form-control" value="" placeholder="">
            </div>
          </div> 
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Zip Code: <span class="text-danger">(*)</span></strong>
              <input type="text" name="zipcode" id="zipcode" class="form-control" value="" placeholder="">
            </div>
          </div>
        </div>
        <div class="row">                        
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Address: <span class="text-danger">(*)</span></strong>
              <input type="text" name="address" id="address" class="form-control" value="" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Cellphone:</strong>
              <input type="text" name="phone" id="phone" class="form-control" value="" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Website:</strong>
              <input type="text" name="website" id="website" class="form-control" value="" placeholder="">
            </div>
          </div>
        </div>                        
        <div class="row">                                  
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Dba:</strong>
              <input type="text" name="dba" id="dba" class="form-control" value="" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Cellphone:</strong>
              <input type="text" name="cellphone" id="cellphone" class="form-control" value="" placeholder="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Secretary Name:</strong>
              <input type="text" name="secretary" id="secretary" class="form-control" value="" placeholder="">
            </div>
          </div> 
        </div>
        <div class="row">                                      
          <input type="hidden" id="token" name="token" value="">
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="button" class="btn btn-primary" id="btn_edit">Save</button>
          </div>
        </div>
      </form>
    </div>  
  </div>
</div>
@endsection