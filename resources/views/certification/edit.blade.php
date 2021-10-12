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
    <div class="row col-md-12 p-4 text-center">
      <div class="col-md-12"><h5>Certification, Authorization</h5></div>
    </div>
    <div class="col-md-12 p-4 text-justify">  
      <form action="{{ route('certification.update',$indiv->id) }}" method="POST" id="frm_createownership">
        <input type="hidden" name="token" id="token" value="{{ $token }}">
        <input type="hidden" name="email" id="email" value="{{ $email }}">
        @csrf
        @method('PUT')
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <p class="text-justify">The applicant certifies that the statement made on this application and the other information provided with this application is true and complete. American Capital Financial Group is authorized to do any necessary credit or background check and to make all inquiries it deems necessary to verify accuracy and determine the Applicant’s creditworthiness.
          </p>
        </div>  
        <center><iframe width="90%" height="400" src="{{asset('master.pdf')}}" frameborder="0"></iframe></center>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group text-center">
            <div class="form-check-inline">
            <label class="form-check-label"> 
              <strong>Approved and Agreed : <span class="text-danger">(*)</span></strong>
            </label>
            <input type="checkbox" name="approved_agreed" id="approved_agreed" class="form-check-input chk_lg" {{ $indiv->approved_agreed }}>
            @error('approved_agreed')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-1 col-md-1"></div>
          <div class="col-xs-12 col-sm-5 col-md-5">
            <div class="form-group">
              <strong>Signer Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="name" id="name" class="form-control" value="{{ $indiv->name }}" placeholder="Name">
              @error('name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-5 col-md-5">
            <div class="form-group">
              <strong>Title: <span class="text-danger">(*)</span></strong>
              <input type="text" name="title" id="title" class="form-control" value="{{ $indiv->title }}" placeholder="Title">
              @error('has_applicant')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-1 col-md-1"></div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button type="submit" class="btn btn-primary" id="btn_save">Save & Next</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

<script src="{{ asset('js/financial.js') }}" defer=""></script>
