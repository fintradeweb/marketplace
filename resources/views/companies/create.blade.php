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
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>   
      </div>
    </div>
  </div>  
@endif

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>New Company</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/companies" class="btn btn-primary">Return</a>
      </div>
    </div> 
    <div class="col-md-10 col-lg-10 col-sm-12 border rounded p-4">   
      <form action="{{ route('companies.store') }}" method="POST">   
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
              <strong>Description:</strong>
              <input type="text" name="description" id="description" class="form-control" placeholder="Description">
            </div>
          </div>
        </div> 
        <div class="row">  
          <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="form-group">
              <strong>Address:</strong>
              <input type="text" name="address" id="address" class="form-control" placeholder="Address">
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