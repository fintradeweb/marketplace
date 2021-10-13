@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-10 text-center"> 
      <h5>Notification List</h5></br>      
      <table width="100%" border="1"> 
        <thead>
          <th class="text-center">From</th>
          <th class="text-center">Date</th>
          <th class="text-center">Description</th>
        </thead> 
        <tbody>
          @foreach ($notifications as $notification)  
            <tr>
              <td><a href="/notification/view/{{$notification->id}}">User</a></td>
              <td><a href="/notification/view/{{$notification->id}}">{{substr($notification->created_at,0,19)}}</a></td>
              <td> 
                <a href="/notification/view/{{$notification->id}}">{{$notification->description}}</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
