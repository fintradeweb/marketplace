@extends('layouts.app')
@section('content')

@if (session('status'))
 <div class="row justify-content-center">
   <div class="col-md-8 col-lg-8 col-sm-12">
     <div class="alert alert-success">
      {{ session('status') }}
     </div>
   </div>
 </div>    
@endif

  <div class="container">
    <div class="row justify-content-center">
      <div class="row col-md-12 p-4">
        <div class="col-md-6"><h5>List of Users</h5></div>
        <div class="col-md-6 ml-auto text-right">
          @if ($rol == 1)
            <a type="button" class="btn btn-primary" href="/users/create">New User</a>
          @endif
        </div>
      </div>
      <div class="col-md-12">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Date created</th>
              <th>Name</th>
              <th>Email</th>
              <th>Credit Status</th>
              <th>Actions</th>
            </tr>        
          </thead>
          <tbody>
            @foreach ($users as $user)                   
              <tr>
                <td>{{ $user->user_id }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if ($user->role_id == 3)
                  <td>{{ $user->credit_status }}</td> 
                @else
                  <td>&nbsp;</td>
                @endif
                <td>
                  @if ($user->role_id == 3)
                    <a href="/users/{{$user->user_id}}">View Credit</a>
                  @else
                    <a href="users/{{$user->user_id}}/edit">Edit</a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>        
      </div>
    </div>
  </div>  
@endsection