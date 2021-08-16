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
      <div class="col-md-12"><h5>Management / Ownership</h5></div>
      <div class="col-md-12">The values ​​must be equal to or greater than 25%, and a maximum of 4 values</div>        
    </div> 
    <div class="col-md-12 p-4">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th width="50%">Name</th>
                <th width="30%">Id Number</th>
                <th width="10%">%</th>
                <th width="10%">Remove</th>              
              </tr>        
            </thead>
            <tbody>                       
            </tbody>
          </table>  
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <form action="/ownership/create" method="POST" id="frm_createownership">
            @csrf            
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Name: <span class="text-danger">(*)</span></strong>
                <input type="text" name="name" id="name" class="form-control" value="" placeholder="Name">
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Id Number: <span class="text-danger">(*)</span></strong>
                <input type="text" name="idnumber" id="idnumber" class="form-control" value="" placeholder="Id Number">                
              </div>
            </div>            
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>% Ownership: <span class="text-danger">(*)</span></strong>
                <input type="text" name="percentage" id="percentage" class="form-control" value="" placeholder="%">
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Position: <span class="text-danger">(*)</span></strong>
                <input type="text" name="position" id="position" class="form-control" value="" placeholder="Position">
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Birthdate: <span class="text-danger">(*)</span></strong>
                <input type="text" name="birthdate" id="birthdate" class="form-control" value="" placeholder="YYYY-MM-DD">
              </div>
            </div>          
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="button" class="btn btn-primary" id="btn_save">Save</button>
            </div>          
          </form>
        </div>      
      </div>
    </div>  
  </div>
</div>
@endsection

<script src="{{ asset('js/ownership.js') }}" defer=""></script>