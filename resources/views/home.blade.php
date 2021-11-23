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
    @if (isset($creditapproved) && count($creditapproved)>0)    
      <div class="col-md-12 col-lg-12 col-sm-12 alert alert-success" role="alert">
        <h5 class="alert-heading">Approved Credit Information</h5>
        <hr>
        @foreach($creditapproved as $credit)
          <p><strong>@if ($credit->type_document == 1) PO @else Invoice @endif:</strong>&nbsp;
          Credit Line: {{$credit->credit_line}}&nbsp;/&nbsp;Advanced:{{$credit->advance}}&nbsp;/&nbsp;Maximum amount:{{$credit->maximun_amount}}&nbsp;/&nbsp;Deadline:{{$credit->deadline}}&nbsp;/&nbsp;Interest Rate:{{$credit->interest_rate}}</p>
        @endforeach				  
      </div>
    @else 
      <div class="col-md-12 col-lg-12 col-sm-12 alert alert-success" role="alert">
        <h5 class="alert-heading">Information</h5>
        <p>Your credit has not been approved yet!</p>
      </div>
    @endif
    <div class="col-md-8">
      <h5>Welcome {{$name}}!</h5></br>      
      <div class="list-group">
        <a href="/home" class="list-group-item list-group-item-action active">Home</a>
        @if (isset($creditapproved) && count($creditapproved)>0)  
          <a href="/financing" class="list-group-item list-group-item-action">Request Financing</a>
        @endif
        @if (isset($documents) && count($documents)>0)  
          <a href="/documents" class="list-group-item list-group-item-action">Documents to Finance</a>
        @endif
      </div> 
    </div>
  </div>
</div>
@endsection
