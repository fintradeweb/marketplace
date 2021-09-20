@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h5>Welcome Admin!</h5></br>
      <div class="list-group">
        <a href="/home" class="list-group-item list-group-item-action active">Home</a>
        <a href="/users" class="list-group-item list-group-item-action">Users</a>
      </div> 
    </div>
  </div>
</div>
@endsection
