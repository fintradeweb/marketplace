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
    <div class="row col-md-10 p-4 text-center">
      <div class="col-md-12"><h5>Bank Information</h5></div>
     </div>
    <div class="col-md-12 p-4 text-justify">
      <form action="{{ route('bankinformation.update',$indiv->id) }}" method="POST" id="frm_createownership">
        <input type="hidden" name="token" id="token" value="{{ $token }}">
        <input type="hidden" name="email" id="email" value="{{ $email }}">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Bank Name: <span class="text-danger">(*)</span></strong>
              <input type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ $indiv->bank_name }}" placeholder="Bank Name">
              @error('bank_name')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Account Name SWIFT: <span class="text-danger">(*)</span></strong>
              <input type="text" name="account_same_swift" id="account_same_swift" class="form-control @error('account_same_swift') is-invalid @enderror" value="{{ $indiv->account_same_swift }}" placeholder="Account Name SWIFT">
              @error('account_same_swift')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Account Number:  <span class="text-danger">(*)</span></strong>
              <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{ $indiv->account_number }}" placeholder="Account Number">
              @error('account_number')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>ABA/Routing #:  <span class="text-danger">(*)</span></strong>
              <input type="text" name="aba_routing" id="aba_routing" class="form-control @error('aba_routing') is-invalid @enderror" value="{{ $indiv->aba_routing }}" placeholder="ABA/Routing #">
              @error('aba_routing')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Bank Address:  <span class="text-danger">(*)</span></strong>
              <input type="text" name="bank_adress" id="bank_adress" class="form-control @error('bank_adress') is-invalid @enderror" value="{{ $indiv->bank_adress }}" placeholder="Bank Address">
              @error('bank_adress')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Telephone:  <span class="text-danger">(*)</span></strong>
              <input type="text" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ $indiv->telephone }}" placeholder="Telephone">
              @error('telephone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Adress:  <span class="text-danger">(*)</span></strong>
              <input type="text" name="adress" id="adress" class="form-control @error('adress') is-invalid @enderror" value="{{ $indiv->adress }}" placeholder="Adress">
              @error('adress')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Account Officer:</strong>
              <input type="text" name="account_officer" id="account_officer" class="form-control @error('account_officer') is-invalid @enderror" value="{{ $indiv->account_officer }}" placeholder="Account Officer">
              @error('account_officer')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4"></div> 
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button  type="submit" class="btn btn-primary" id="btn_save">Save & Next</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

