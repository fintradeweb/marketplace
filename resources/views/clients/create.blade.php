@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>New Client</h5></div>
      <div class="col-md-6" align="right">
        <a href="/clients" class="btn btn-link">Return</a>
      </div>
    </div> 
    <div class="col-md-10">
      <clients-create-component></client-create-component> 
    </div>
  </div>
</div>  
@endsection