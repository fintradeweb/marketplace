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
      <div class="col-md-6"><h5>Update User</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/users" class="btn btn-primary">Return</a>
      </div>
    </div>
    <div class="col-md-10 col-lg-10 col-sm-12 border rounded p-4">   
      <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')        
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Name:</strong>
              <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="Name">
              <input type="hidden" name="rol_id" id="rol_id" value="{{ $user->role->role_id }}">
            </div>
          </div>
        </div>  
        <div class="row">  
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Email:</strong>
              <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="Email">
            </div>
          </div>
        </div>   
        <div class="row">  
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
              <strong>Password:</strong>
              <input type="text" name="password" id="password" class="form-control" value="" placeholder="Password">
              <span class="font-italic text-info">Min:6 chr Max:20chr</span>
            </div>
          </div>
        </div>   
        <div class="row">   
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">              
              <div class="form-check form-check-inline">
                <input class="form-check-input" id="status" name="status" type="checkbox" @if ($user->status) value="1" @else value="0" @endif  @if ($user->status) checked @endif>
              </div>
              <label class="form-check-label" for="flexCheckDefault"><strong>Active</strong></label>              
            </div>
          </div>
        </div>        
        <div class="row">   
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="reset" class="btn btn-secondary" id="btnreset">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>        
      </form>
    </div>
  </div>
</div>
@endsection

<script src="{{ asset('js/user.js') }}" defer=""></script>