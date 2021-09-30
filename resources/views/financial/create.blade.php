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
      <div class="col-md-12"><h5>Financial Request (Financial Information)</h5></div>
     </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
          <form action="{{ route('financial.store') }}" method="POST" id="frm_createownership">
            <input type="hidden" name="token" id="token" value="{{ $token }}">
            <input type="hidden" name="email" id="email" value="{{ $email }}">
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Avg monthly sales: <span class="text-danger">(*)</span></strong>
                    <input type="text" name="avg_montky_sales" id="avg_montky_sales" class="form-control @error('avg_montky_sales') is-invalid @enderror" value="{{ $indiv->avg_montky_sales }}" placeholder="Avg monthly sales">
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
                    <input type="text" name="ams_how_clients" id="ams_how_clients" class="form-control @error('ams_how_clients') is-invalid @enderror" value="{{ $indiv->ams_how_clients }}" placeholder="Number clients">
                    @error('ams_how_clients')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <div class="form-check-inline col-md-10">                  
                  <strong>
                    Has applicant or any entity in which applicant is an owner / partner owe any taxes that are past due?: <span class="text-danger">(*)</span>
                  </strong>
                  &nbsp;&nbsp;&nbsp;
                  <select name="has_applicant" id="has_applicant" class="form-control col-md-2 @error('has_applicant') is-invalid @enderror">                    
                    <option value="0">No</option>
                    <option value="1">Yes</option>                    
                  </select>
                  <!--<input type="checkbox" name="has_applicant" id="has_applicant" class="form-check-input chk_lg" {{ $indiv->has_applicant }} >-->
                  @error('has_applicant')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            
            <div class="card">
              <div class="card-body">  
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Estimated monthly financing volume: <span class="text-danger">(*)</span></strong>
                    <input type="text" name="estimated_montly_financing" id="estimated_montly_financing" class="form-control @error('estimated_montly_financing') is-invalid @enderror" value="{{ $indiv->estimated_montly_financing }}" placeholder="Estimated monthly financing volume">
                    @error('estimated_montly_financing')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Number of clients to finance? <span class="text-danger">(*)</span></strong>
                    <input type="text" name="emf_number_clients" id="emf_number_clients" class="form-control @error('emf_number_clients') is-invalid @enderror" value="{{ $indiv->emf_number_clients }}" placeholder="Number clients">
                    @error('emf_number_clients')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>What type of documents are you looking to finance (PO- Invoice)?  
                  <span class="text-danger">(*)</span>
                </strong>
              </div>  
              <div class="form-group">
                <center>
                  <div class="form-check-inline">
                    <label class="form-check-label"><strong>Purchase Order</strong></label>
                    <input type="checkbox" name="po_finance" id="po_finance" class="form-check-input chk_lg @error('po_finance') is-invalid @enderror" {{ $indiv->po_finance }}>
                    @error('po_finance')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label"><strong>Invoice</strong></label>
                    <input type="checkbox" name="in_finance" id="in_finance" class="form-check-input chk_lg @error('in_finance') is-invalid @enderror" {{ $indiv->in_finance }} >
                    @error('in_finance')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </center>
              </div>
            </div>
            <br> 
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <div class="form-check-inline col-md-10">                   
                  <strong>Has applicant or any entity in which applicant is an owner / partner has any lawsuits pending? <span class="text-danger">(*)</span>
                  </strong>                  
                  &nbsp;&nbsp;&nbsp;
                  <select name="lawsuits_pending" id="lawsuits_pending" class="form-control col-md-2 @error('lawsuits_pending') is-invalid @enderror">                    
                    <option value="0">No</option>
                    <option value="1">Yes</option>                    
                  </select>
                  <!--<input type="checkbox" name="lawsuits_pending" id="lawsuits_pending" class="form-check-input chk_lg"  {{ $indiv->lawsuits_pending }} >-->
                  @error('lawsuits_pending')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div> 
              </div>
            </div>

            <div class="card">
              <div class="card-body">    
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <div class="form-check-inline col-md-10">                       
                      <strong>Have you ever factored your receivables? <span class="text-danger">(*)</span></strong>                      
                      &nbsp;&nbsp;&nbsp;
                      <select name="receivable_finance" id="receivable_finance" class="form-control col-md-2 @error('receivable_finance') is-invalid @enderror">                    
                        <option value="0">No</option>
                        <option value="1">Yes</option>                    
                      </select>                      
                      <!--<input type="checkbox" name="receivable_finance" id="receivable_finance" class="form-check-input chk_lg" {{ $indiv->receivable_finance }} >-->
                      @error('receivable_finance')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>If yes, when/with whom?</strong>
                    <input type="text" name="rf_when_with_whom" id="rf_when_with_whom" class="form-control @error('rf_when_with_whom') is-invalid @enderror" placeholder="" value="{{ $indiv->rf_when_with_whom }}" >
                    @error('rf_when_with_whom')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="card">
              <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <div class="form-check-inline col-md-10">                        
                      <strong>Do you have a Credit Insurance policy? <span class="text-danger">(*)</span></strong>                      
                      &nbsp;&nbsp;&nbsp; 
                      <select name="credit_insurance_policy" id="credit_insurance_policy" class="form-control col-md-2 @error('credit_insurance_policy') is-invalid @enderror">                    
                        <option value="0">No</option>
                        <option value="1">Yes</option>                    
                      </select>                      
                      <!--<input type="checkbox" name="credit_insurance_policy" id="credit_insurance_policy" class="form-check-input chk_lg" {{ $indiv->credit_insurance_policy }} >-->
                      @error('credit_insurance_policy')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>If yes, when/with whom?</strong>
                    <input type="text" name="cip_when_with_whom" id="cip_when_with_whom" class="form-control @error('cip_when_with_whom') is-invalid @enderror" placeholder="" value="{{ $indiv->cip_when_with_whom }}" >
                    @error('cip_when_with_whom')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <div class="form-check-inline col-md-10">                   
                  <strong>Has applicant or any entity in which applicant is an owner / partner ever declared bankruptcy? <span class="text-danger">(*)</span></strong>                  
                  &nbsp;&nbsp;&nbsp;
                  <select name="declared_bank_ruptcy" id="declared_bank_ruptcy" class="form-control col-md-2 @error('declared_bank_ruptcy') is-invalid @enderror">                    
                    <option value="0">No</option>
                    <option value="1">Yes</option>                    
                  </select>
                  <!--<input type="checkbox" name="declared_bank_ruptcy" id="declared_bank_ruptcy" class="form-check-input chk_lg" {{ $indiv->declared_bank_ruptcy }} >-->
                  @error('declared_bank_ruptcy')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary" id="btn_save">Save & Next</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<script src="{{ asset('js/financial.js') }}" defer=""></script>
