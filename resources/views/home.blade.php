@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    @if (isset($creditapproved) && !empty($creditapproved))    
      <div class="col-md-12 col-lg-12 col-sm-12 alert alert-success" role="alert">
        <h5 class="alert-heading">Approved Credit Information</h5>
        <hr>
        @foreach($creditapproved as $credit)
          <p><strong>@if ($credit->type_document == 1) PO @else Invoice @endif:</strong>&nbsp;
          Credit Line: {{$credit->credit_line}}&nbsp;/&nbsp;Advanced:{{$credit->advance}}&nbsp;/&nbsp;Maximum amount:{{$credit->maximun_amount}}&nbsp;/&nbsp;Deadline:{{$credit->deadline}}&nbsp;/&nbsp;Interest Rate:{{$credit->interest_rate}}</p>
        @endforeach				  
      </div>
    @endif
    <div class="col-md-8">
      <h5>Welcome {{$name}}!</h5></br>      
      <div class="list-group">
        <a href="/home" class="list-group-item list-group-item-action active">Home</a>
        <a href="/financing" class="list-group-item list-group-item-action">Request Financing</a>
      </div> 
    </div>
  </div>
</div>
@endsection
