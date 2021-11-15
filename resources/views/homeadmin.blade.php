@extends('layouts.app')
@section('content')

@if (session('status'))
 <div class="row justify-content-center">
   <div class="col-md-8 col-lg-8 col-sm-12">
     <div class="alert alert-success">
      {{ session('status') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
     </div>
   </div>
 </div>    
@endif

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h5>Welcome {{$name}}!</h5></br>
      <div class="list-group">
        <a href="/home" class="list-group-item list-group-item-action active">Home</a>
        <a href="/users" class="list-group-item list-group-item-action">Borrower Users</a>
        <a href="/documents" class="list-group-item list-group-item-action">Documents</a>
      </div> 
    </div>
  </div>
</div>
@endsection
