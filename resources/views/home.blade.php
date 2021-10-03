@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h5>Welcome User!</h5></br>
      @if (isset($creditapproved) && !empty($creditapproved))
        <div class="alert alert-success" role="alert">
				  <h4 class="alert-heading">Well done!</h4>
				  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
				  <hr>
				  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
				</div>
      @endif
      <div class="list-group">
        <a href="/home" class="list-group-item list-group-item-action active">Home</a>
        <a href="/financing" class="list-group-item list-group-item-action">Request Financing</a>
      </div> 
    </div>
  </div>
</div>
@endsection
