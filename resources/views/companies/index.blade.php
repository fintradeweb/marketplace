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
      <div class="row col-md-12 p-4">
        <div class="col-md-6"><h5>List of Companies</h5></div>
        <div class="col-md-6 ml-auto text-right">
          <a type="button" class="btn btn-primary" href="/companies/create">New Company</a>
        </div>
      </div>
      <div class="col-md-12">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Date created</th>
              <th>Name</th>
              <th>Description</th>
              <th>Address</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>        
          </thead>
          <tbody>
            @foreach ($companies as $company)              
              <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->created_at }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->description }}</td>
                <td>{{ $company->address }}</td>
                @if ($company->active)
                  <td>Active</td>
                @else
                  <td>Inactive</td>
                @endif                
                <td align="center">
                  <a href="/companies/{{$company->id}}" data-toggle="tooltip" data-placement="top" title="View">
                    <i class="fa fa-search" aria-hidden="true" style="font-size:25px;"></i>
                  </a> 
                  &nbsp;
                  <a href="companies/{{$company->id}}/edit" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:25px;"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>        
      </div>
    </div>
  </div>  
@endsection