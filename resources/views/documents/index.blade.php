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
        <div class="col-md-6"><h5>List of Documents Financing</h5></div>
        <div class="col-md-6 ml-auto text-right">
          <a type="button" class="btn btn-primary" href="/documents">Return</a>
        </div>
      </div>
      
      <div class="col-md-12">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Type Document</th>
              <th>Date Created</th>
              <th>Due Date</th>
              <th>Amount</th>
              <th>Actions</th>
            </tr>        
          </thead>
          <tbody>
            @foreach ($documents as $document)                   
              <tr>
                <td>{{ $document->id }}</td>
                <td>{{ $document->type_doc }}</td>
                <td>{{ $document->created_at }}</td>
                <td>{{ $document->due_date }}</td>
                <td>{{ $document->amount }}</td> 
                <td align="center">           
                  <a href="/document/{{$document->id}}" data-toggle="tooltip" data-placement="top" title="View More Info">
                    <i class="fa fa-search" aria-hidden="true" style="font-size:25px;"></i>
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