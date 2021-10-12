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
    <div class="row col-md-12 p-4">
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12"></div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <h4 class="text-justify">We are reviewing the information provided to grant you a line of credit in 24 hours. We will notify you at your email address of the approval of your line of credit</h4>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12"></div>
      </div>
      <div class="row col-md-12">&nbsp;</div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <center>
          <img src="{{ asset('image/final_credit.jpg') }}" class="rounded float-center" width="400" height="300"> 
        </center>
      </div>
      <div class="row col-md-12">&nbsp;</div>
      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a href="{{ url('/login') }}" class="btn btn-primary">Go to Marketplace</a>
      </div>
    </div>
  </div>
</div>
@endsection


