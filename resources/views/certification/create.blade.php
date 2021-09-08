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
      <div class="col-md-12"><h5>Certification, Authorization</h5></div>
      <p>The applicant certifies that the statement made on this application and the other information provided with this application is true and complete. American Capital Financial Group is authorized to do any necessary credit or background check and to make all inquiries it deems necessary to verify accuracy and determine the Applicant’s creditworthiness.
(El aplicante certifica que, las declaraciones e información provista en esta aplicación son veraces y completas. American Capital Financial Group está autorizado para hacer todas las investigaciones que considere necesarias para verificar la exactitud y determinar la solvencia del aplicante.)
</p>
     </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
          <form action="{{ route('certification.store') }}" method="POST" id="frm_createownership">
            <input type="hidden" name="token" id="token" value="{{ $token }}">
            <input type="hidden" name="email" id="email" value="{{ $email }}">
            @csrf
            <div class="col-xs-12 col-sm-12 col-md-12">
            <center><iframe width="400" height="400" src="{{asset('master.pdf')}}" frameborder="0"></iframe></center>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Approved and Agreed : <span class="text-danger">(*)</span></strong>
                <input type="checkbox" name="approved_agreed" id="approved_agreed" class="form-control" {{ $indiv->approved_agreed }}>
                @error('approved_agreed')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Name: <span class="text-danger">(*)</span></strong>
                <input type="text" name="name" id="name" class="form-control" value="{{ $indiv->name }}" placeholder="Name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
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


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button  type="submit" class="btn btn-primary" id="btn_save">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


