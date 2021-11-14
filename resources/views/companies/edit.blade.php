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
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>Update Company</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/companies" class="btn btn-primary">Return</a>
      </div>
    </div>
    <div class="col-md-10 col-lg-10 col-sm-12 border rounded p-4">   
      <form action="{{ route('companies.update',$company->id) }}" method="POST">
        @csrf
        @method('PUT')        
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Name:</strong>
              <input type="text" name="name" id="name" class="form-control" value="{{ $company->name }}"  placeholder="Name">
            </div>
          </div>
        </div>  
        <div class="row">  
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Description:</strong>
              <input type="text" name="description" id="description" class="form-control"  value="{{ $company->description }}" placeholder="Description">
            </div>
          </div>
        </div>   
        <div class="row">  
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Address:</strong>
              <input type="text" name="address" id="address" class="form-control"  value="{{ $company->address }}" placeholder="Address">
            </div>
          </div>
        </div>   
        <div class="row">   
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">              
              <div class="form-check form-check-inline">
                <input class="form-check-input" id="active" name="active" type="checkbox" @if ($company->active) value="1" @else value="0" @endif  @if ($company->active) checked @endif>
              </div>
              <label class="form-check-label" for="flexCheckDefault"><strong>Active</strong></label>              
            </div>
          </div>
        </div>        
        <div class="row">   
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="reset" class="btn btn-secondary" id="btnreset">Reset</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>        
      </form>
    </div>
  </div>
</div>
@endsection

<script src="{{ asset('js/company.js') }}" defer=""></script>