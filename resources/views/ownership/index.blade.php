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
        <div class="col-xs-12 col-sm-8 col-md-8 text-center">
          <table class="table table-hover table-bordered" id="tblowner">
            <thead>
              <tr>
                <th width="30%">Name</th>
                <th width="20%">Id Number</th>
                <th width="10%">%</th>
                <th width="20%">Position</th>
                <th width="10%">Birthdate</th>
                <th width="10%">Remove</th>              
              </tr>        
            </thead>
            <tbody>
             @foreach ($records as $record)  
               <tr>
                <td>{{ $record->name }}</td>
                <td>{{ $record->idno }}</td>
                <td>{{ $record->percentage }}</td>
                <td>{{ $record->position }}</td>
                <td>{{ $record->birthdate }}</td>
                <td align="center"><a href=""><i class='fa fa-trash-o'></i></a> </td>
              </tr>
             @endforeach  
            <!--consulta de los ownershio de ese usuario ingresados-->                       
            </tbody>
          </table> 
        </div>
        
        <div class="col-xs-12 col-sm-4 col-md-4">
          <form action="{{ route('managment.store') }}" method="POST" id="frm_createownership">
            <input type="hidden" name="token" id="token" value="{{ $token }}">  
            <input type="hidden" name="email" id="email" value="{{ $email }}">     
            @csrf            
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Name: <span class="text-danger">(*)</span></strong>
                <input type="text" name="name" id="name" class="form-control" value="" placeholder="Name">
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_name" style="display:none;"></strong>
                </span>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Id Number: <span class="text-danger">(*)</span></strong>
                <input type="text" name="idnumber" id="idnumber" class="form-control" value="" placeholder="Id Number"> 
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_idnumber" style="display:none;"></strong>
                </span>               
              </div>
            </div>            
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>% Ownership: <span class="text-danger">(*)</span></strong>
                <input type="text" name="percentage" id="percentage" class="form-control" value="" placeholder="%">
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_percentage" style="display:none;"></strong>
                </span>  
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Position: <span class="text-danger">(*)</span></strong>
                <input type="text" name="position" id="position" class="form-control" value="" placeholder="Position">
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_position" style="display:none;"></strong>
                </span>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Birthdate: <span class="text-danger">(*)</span></strong>
                <input type="text" name="birthdate" id="birthdate" class="form-control" value="" placeholder="YYYY-MM-DD">
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_birthdate" style="display:none;"></strong>
                </span>
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