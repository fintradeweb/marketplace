@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="row col-md-12 p-4"> 
      <div class="col-md-6"><h5>Notification List @if($type == "received") Received @else Sent @endif</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/"class="btn btn-primary">Return</a>
      </div>      
    </div> 
    @if ($type == "received")
      <div class="row col-md-12 mb-4">
        <table width="25%">
          <tr>
            <td><strong>Legend:</strong></td>
            <td style="background-color:#ffffff;">Read</td>
            <td style="background-color:#f9d9f1;">Not Read</td>
          </tr>
        </table>
      </div>
    @endif
    <div class="col-md-12">
      <div class="list-group">
        @if (count($notifications) > 0)
          @foreach ($notifications as $notification)              
            <a href="/notification/view/{{$type}}/{{$notification->id}}" class="list-group-item list-group-item-action" @if ($type == "received" && $notification->is_read == "0") style="background-color:#f9d9f1;" @endif>
              
              <div class="d-flex w-100 justify-content-between">
                @if ($type == "received")
                  <h5 class="mb-1">{{$notification->send_by_name}} - {{$notification->send_by_email}}</h5>
                @else
                  <h5 class="mb-1">{{$notification->name}} - {{$notification->email}}</h5>
                @endif
                
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
