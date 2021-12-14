@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-12 p-4">
      <div class="col-md-6"><h5>Deny Document to finance for User - {{$user->name}}</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/documents"class="btn btn-primary">Return</a>
      </div>
    </div> 

    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <form action="{{ route('documents.storereject') }}" method="POST">
            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
            <input type="hidden" name="document_id" id="document_id" value="{{ $document->id }}">   
            <input type="hidden" name="type_doc" id="type_doc" value="{{ $document->type_doc }}">            
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Observation:<span class="text-danger">(*)</span></strong>                             
                    <textarea class="form-control @error('observation') is-invalid @enderror" id="observation" name="observation" rows="3"></textarea>                     
                    @error('observation')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
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