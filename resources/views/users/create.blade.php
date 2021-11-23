@extends('layouts.app')
@section('content')

@if ($errors->any())
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-8 col-sm-12">
      <div class="alert alert-danger" role="alert">  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>      
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
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>New User</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/users" class="btn btn-primary">Return</a>
      </div>
    </div> 
    <div class="col-md-10 col-lg-10 col-sm-12 border rounded p-4">   
      <form action="{{ route('users.store') }}" method="POST">   
        @csrf   
        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="form-group">
              <strong>Name:</strong>
              <input type="text" name="name" id="name" class="form-control" placeholder="Name">
            </div>
          </div>
        </div> 
        <div class="row">  
          <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="form-group">
              <strong>Email:</strong>
              <input type="text" name="email" id="email" class="form-control" placeholder="Email">
            </div>
          </div>
        </div> 
        <div class="row">  
          <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="form-group">
              <strong>Password:</strong>
              <input type="text" name="password" id="password" class="form-control" placeholder="Password">
              <span class="font-italic text-info">Min:6 chr Max:20chr</span>
            </div>
          </div>
        </div> 
        <div class="row">  
          <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="form-group">
              <strong>Rol:</strong>
              <select id="rol_id" name="rol_id" class="form-control">
                <option value="1">Super Admin</option>
                <option value="2">Lender</option>
              </select>
            </div>
          </div>
        </div> 
        <div class="row" style="display:none;" id="divcompany">  
          <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="form-group">
              <strong>Company:</strong>
              <select id="company_id" name="company_id" class="form-control">
                @foreach ($companies as $company)
                  <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div> 
        <div class="row"> 
          <div class="col-md-12 text-center">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </form>      
    </div>
  </div>
</div>  
@endsection

<script src="{{ asset('js/user.js') }}" defer=""></script>