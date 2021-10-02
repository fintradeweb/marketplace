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
      <div class="row col-md-12 p-2">
        <div class="col-md-6"><h5>List of Borrower Users</h5></div>
        <div class="col-md-6 ml-auto text-right">
          @if ($rol == 1)
            <a type="button" class="btn btn-primary" href="/users/create">New User</a>
          @endif
        </div>
      </div>
      
      @if ($rol == 1)
        <div class="row col-md-12 p-4">
          <div class="col-md-4 col-sm-12 col-lg-4 text-center">
            <a type="button" class="btn btn-{{$css_borrow}}" href="/users/3/type">Borrowers</a>
          </div>
          <div class="col-md-4 col-sm-12 col-lg-4 text-center">
            <a type="button" class="btn btn-{{$css_admin}}" href="/users/2/type">Admin</a>
          </div>
          <div class="col-md-4 col-sm-12 col-lg-4 text-center">
            <a type="button" class="btn btn-{{$css_sadmin}}" href="/users/1/type">SuperAdmin</a>
          </div>
        </div>
      @endif

      <div class="col-md-12">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Date created</th>
              <th>Name</th>
              <th>Email</th>
              @if ($css_borrow == 'primary')
                <th>Credit Status</th>
              @endif
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
                @if ($css_borrow == 'primary')
                  @if ($user->role_id == 3)
                    <td>{{ $user->credit_status }}</td> 
                  @else
                    <td>&nbsp;</td>
                  @endif
                @endif 
                <td align="center">
                  @if ($user->role_id == 3)                    
                    <a href="/users/{{$user->user_id}}" data-toggle="tooltip" data-placement="top" title="View Credit">
                      <i class="fa fa-address-book-o" aria-hidden="true" style="font-size:25px;"></i>
                    </a>                                        
                  @else
                    <a href="users/{{$user->user_id}}/edit" data-toggle="tooltip" data-placement="top" title="Edit">
                      <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:25px;"></i>
                    </a>
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