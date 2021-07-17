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
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>New Client</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/clients" class="btn btn-primary">Return</a>
      </div>
    </div> 
    <div class="col-md-10 col-lg-10 col-sm-12 border rounded p-4">   
      <form action="{{ route('clients.store') }}" method="POST">   
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
          <div class="col-md-12 text-center">
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>      
    </div>
  </div>
</div>  
@endsection