@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-12 text-center"> 
      <h5>Notification List</h5></br>         
      <div class="list-group">
        @if (count($notifications) > 0)
          @foreach ($notifications as $notification)  
            <a href="/notification/view/{{$type}}/{{$notification->id}}" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$notification->send_by_name}} - {{$notification->send_by_email}}</h5>
                @php
                $timestamp = strtotime($notification->created_at);  
                $date = date('H:i (d M, Y)', $timestamp);
                @endphp
                <small>{{$date}}</small>
              </div>
              <p class="mb-1 text-justify">
              @if (strlen($notification->description) > 50)
                {{substr($notification->description,0,50)}}...
              @else 
                {{$notification->description}} 
              @endif
              </p>
              <small>
                @switch($notification->type_not)
                  @case("askmoreinformation")
                    Ask for more information
                    @break                
                @endswitch
              </small>
            </a>          
          @endforeach
        @else
          There is not information
        @endif
      
      </div>  
    </div>
  </div>
</div>
@endsection
