@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-12 p-4">
      <div class="col-md-6"><h5>Edit Credit User for - {{$user->name}}</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/users"class="btn btn-primary">Return</a>
      </div>
    </div> 

    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
          <form action="{{ route('credit.update') }}" method="POST" id="frm_creditedit">
            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">                                 
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <strong><h5 class="text-center">PO</h5></strong>
                    <input type="hidden" name="id_po" id="id_po" value="{{$credit_po->id}}">
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">
                        <strong>Credit Line Amount:<span class="text-danger">(*)</span></strong>                 
                        <input type="text" name="credit_line_po" id="credit_line_po" class="form-control @error('credit_line_po') is-invalid @enderror" value="{{$credit_po->credit_line}}" placeholder="Credit Line">
                        @error('credit_line_po')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">   
                        <strong>Advanced Percentage:<span class="text-danger">(*)</span></strong>                
                        <input type="text" name="advance_po" id="advance_po" class="form-control @error('advance_po') is-invalid @enderror" value="{{$credit_po->advance}}" placeholder="Advance">
                        @error('advance_po')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">
                        <strong>Maximum amount per transaction:<span class="text-danger">(*)</span></strong>  
                        <input type="text" name="maximum_amount_po" id="maximum_amount_po" class="form-control @error('maximum_amount_po') is-invalid @enderror" value="{{$credit_po->maximum_amount}}" placeholder="Maximum amount">
                        @error('maximum_amount_po')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">   
                        <strong>Deadline:<span class="text-danger">(*)</span></strong>                          
                        <input type="text" name="deadline_po" id="deadline_po" class="form-control @error('deadline_po') is-invalid @enderror" value="{{$credit_po->deadline}}" placeholder="Deadline">
                        @error('deadline_po')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">
                        <strong>Interest Rate:</strong>                    
                        <input type="text" name="interest_rate_po" id="interest_rate_po" class="form-control @error('interest_rate_po') is-invalid @enderror" value="{{$credit_po->interest_rate}}" placeholder="Interest Rate">
                        @error('interest_rate_po')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-6"></div>
                  </div>
                </div>               
              </div>
            </div>  
            <br>    
            <div class="card">
              <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <strong><h5 class="text-center">Invoice</h5></strong>
                    <input type="hidden" name="id_invoice" id="id_invoice" value="{{$credit_iv->id}}">
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">
                        <strong>Credit Line Amount:<span class="text-danger">(*)</span></strong>             
                        <input type="text" name="credit_line_invoice" id="credit_line_invoice" class="form-control @error('credit_line_invoice') is-invalid @enderror" value="{{$credit_iv->credit_line}}" placeholder="Credit Line">
                        @error('credit_line_invoice')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">   
                        <strong>Advanced Percentage:<span class="text-danger">(*)</span></strong>           
                        <input type="text" name="advance_invoice" id="advance_invoice" class="form-control @error('advance_invoice') is-invalid @enderror" value="{{$credit_iv->advance}}" placeholder="Advance">
                        @error('advance_invoice')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">
                        <strong>Maximum amount per transaction:<span class="text-danger">(*)</span></strong> 
                        <input type="text" name="maximum_amount_invoice" id="maximum_amount_invoice" class="form-control @error('maximum_amount_invoice') is-invalid @enderror" value="{{$credit_iv->maximum_amount}}" placeholder="Maximum amount">
                        @error('maximum_amount_invoice')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">   
                        <strong>Deadline:<span class="text-danger">(*)</span></strong>                          
                        <input type="text" name="deadline_invoice" id="deadline_invoice" class="form-control @error('deadline_invoice') is-invalid @enderror" value="{{$credit_iv->deadline}}" placeholder="Deadline">
                        @error('deadline_invoice')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                      <div class="form-group">
                        <strong>Interest Rate:</strong>                     
                        <input type="text" name="interest_rate_invoice" id="interest_rate_invoice" class="form-control @error('interest_rate_invoice') is-invalid @enderror" value="{{$credit_iv->interest_rate}}" placeholder="Interest Rate">
                        @error('interest_rate_invoice')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-6"></div>
                  </div>
                </div>               
              </div>
            </div>  
            <br>      
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="reset" class="btn btn-secondary" id="btnreset">Reset</button>
              <button type="submit" class="btn btn-primary" id="btn_save">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection