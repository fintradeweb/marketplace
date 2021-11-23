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

      @if ($rol == 2)
        <form action="{{ route('users.search') }}" method="post" class="col-md-12 col-lg-12 col-sm-12"> 
          @csrf
          <div class="row col-md-12 mb-4">
            <div class="col-md-3"><label>Status:</label>
              <select name="status" id="status" class="form-control">
                @foreach ($status as $value)
                  <option value="{{$value->status}}">{{$value->status}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2"><label>Date start:</label>
              <input type="text" name="date_start" id="date_start" size="10" maxlength="10" class="form-control input-sm" value="" placeholder="YYYY-MM-DD">
            </div>
            <div class="col-md-2"><label>Date end:</label>
              <input type="text" name="date_end" id="date_end" size="10" maxlength="10" class="form-control" value="" placeholder="YYYY-MM-DD">
            </div>
            <div class="col-md-3"><label>Ruc:</label>
              <input type="text" name="ruc" id="ruc" class="form-control" value="" placeholder="09999999999001">
            </div>
            <div class="col-md-2"><label>&nbsp;</label>
              <button type="submit" class="form-control btn btn-primary">Search</button>
            </div>  
          </div>
        </form> 
      @endif

      <div class="row col-md-12 mb-4">
        <table width="25%">
          <tr>
            <td><strong>Legend:</strong></td>
            <td style="background-color:#e7ebee;">Buyers</td>
            <td style="background-color:#f9d9f1;">Sellers</td>
          </tr>
        </table>
      </div>      
      
      @if ($rol == 1)
        <div class="row col-md-12 p-4">
          <div class="col-md-4 col-sm-12 col-lg-4 text-center">
            <a type="button" class="btn btn-{{$css_borrow}}" href="/users/3/type">Borrowers</a>
          </div>
          <div class="col-md-4 col-sm-12 col-lg-4 text-center">
            <a type="button" class="btn btn-{{$css_admin}}" href="/users/2/type">Lenders</a>
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
              <tr style="background-color: @if ($user->is_buyer == 1) #e7ebee @elseif ($user->is_seller == 1) #f9d9f1 @endif">
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
                    @if ($user->credit_status == "Credit Approved")
                      &nbsp;
                      <a href="/credit/{{$user->user_id}}/edit" data-toggle="tooltip" data-placement="top" title="Edit Credit">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:25px;"></i>                      
                      </a>
                    @endif
                  @else
                    <a href="/users/{{$user->user_id}}/edit" data-toggle="tooltip" data-placement="top" title="Edit">
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