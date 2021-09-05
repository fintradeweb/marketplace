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
      <div class="col-md-12"><h5>Financial Request</h5></div>
     </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-12">
          <form action="{{ route('financial.store') }}" method="POST" id="frm_createownership">
            <input type="hidden" name="token" id="token" value="{{ $token }}">
            <input type="hidden" name="email" id="email" value="{{ $email }}">
            @csrf
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Avg Monthly sales: <span class="text-danger">(*)</span></strong>
                <input type="text" name="avg_montky_sales" id="avg_montky_sales" class="form-control" value="{{ $indiv->avg_montky_sales }}" placeholder="Avg Monthly sales">
                @error('avg_montky_sales')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>In how many clients? <span class="text-danger">(*)</span></strong>
                <input type="text" name="ams_how_clients" id="ams_how_clients" class="form-control" value="{{ $indiv->ams_how_clients }}" placeholder="Clients">
                @error('ams_how_clients')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Has applicant or any entity in which applicant is an owner / partner owe any taxes that are past due?: <span class="text-danger">(*)</span></strong>
                <input type="checkbox" name="has_applicant" id="has_applicant" class="form-control" value="{{ $indiv->has_applicant }}" >
                @error('has_applicant')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Estimated Monthly Financing Volume: <span class="text-danger">(*)</span></strong>
                <input type="text" name="estimated_montly_financing" id="estimated_montly_financing" class="form-control" value="{{ $indiv->estimated_montly_financing }}" placeholder="">
                @error('estimated_montly_financing')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Birthdate: <span class="text-danger">(*)</span></strong>
                <input type="text" name="emf_number_clients" id="emf_number_clients" class="form-control"value="{{ $indiv->emf_number_clients }}" placeholder="">
                @error('emf_number_clients')
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

