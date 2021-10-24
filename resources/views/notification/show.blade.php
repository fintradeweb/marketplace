@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>Consult Notification</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/notification/{{$type}}"class="btn btn-primary">Return</a>
      </div>
    </div> 
    <div class="col-md-10">                 
      <div class="card">      
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h5 class="card-title">
              @if ($type == "sent")
                To
              @else 
                From 
              @endif
              :</h5>
              <p class="card-text">{{$notification->name}} - {{$notification->email}}</p>  
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Date:</h5>
              <p class="card-text">
                @php
                $timestamp = strtotime($notification->created_at);  
                $date = date('H:i:s (d M, Y)', $timestamp);
                @endphp
                {{$date}}
              </p>  
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Type Notification:</h5>
              <p class="card-text">
                @switch($notification->type_not)
                  @case("askmoreinformation")
                    Ask for more information
                    @break                
                @endswitch
              </p>  
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Description:</h5>
              <p class="card-text">{{$notification->description}}</p>  
            </li>          
          </ul>                
        </div>               
      </div>
    </div> 
    @if ($type == "received")
      <div class="col-md-10 p-4 text-center">
        <a href="/notification/{{$type}}"class="btn btn-primary">Reply</a>
      </div> 
    @endif
  </div>
</div>  
@endsection