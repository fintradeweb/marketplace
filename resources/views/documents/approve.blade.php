@extends('layouts.app')
@section('content')

@if ($errors->any())
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-8 col-sm-12">
      <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
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
    <div class="row col-md-12 p-4">
      <div class="col-md-6"><h5>Approve Document for User - {{$user->name}}</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/documents"class="btn btn-primary">Return</a>
      </div>
    </div> 

    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

          <form action="{{ route('documents.storeapprove') }}" method="POST">
            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
            <input type="hidden" name="document_id" id="document_id" value="{{ $document->id }}">                                 
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    @foreach($credit as $row)
                      <h5 class="text-center"><strong>@if ($row->type_document == 1) PO @else Invoice @endif:</strong>&nbsp;
                      Credit Line Amount: ${{$row->credit_line}}&nbsp;/&nbsp;Maximum amount per transaction:${{$row->maximum_amount}}</h5>
                    @endforeach     
                  </div>
                  <div class="row">
                    <hr>
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-sm-4 col-lg-4">
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                      <div class="form-group">
                        <strong>Document:</strong>                 
                        <a href="//{{$document->url_doc}}" target="blank" >Show Document</a>
                      </div>  
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-sm-4 col-lg-4">
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                      <div class="form-group">
                        <strong>Type of document:</strong>                 
                        {{$document->type_doc}}
                      </div>  
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-sm-4 col-lg-4">
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                      <div class="form-group">
                        <strong>Amount:<span class="text-danger">(*)</span></strong>                 
                        <input type="text" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="" placeholder="Amount">
                        @error('amount')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>  
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                    </div>
                  </div>
                  
                </div>               
              </div>
            </div>  
            <br>          
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <a href="/documents/{{$document->id}}/reject" class="btn btn-secondary">Reject</a>
              <button type="submit" class="btn btn-primary" id="btn_save">Approve</button>
            </div>
          </form>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection

<script src="{{ asset('js/document.js') }}" defer=""></script>