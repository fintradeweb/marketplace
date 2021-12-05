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
          <a type="button" class="btn btn-primary" href="/home">Return</a>
        </div>
      </div>
      
      <form action="{{ route('documents.search') }}" method="post" class="col-md-12 col-lg-12 col-sm-12"> 
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
          @if ($role == "Admin")
            <div class="col-md-3"><label>Ruc:</label>
              <input type="text" name="ruc" id="ruc" class="form-control" value="" placeholder="09999999999001">
            </div>
          @endif
          <div class="col-md-2"><label>&nbsp;</label>
            <button type="submit" class="form-control btn btn-primary">Search</button>
          </div>  
        </div>
      </form> 

      <div class="col-md-12">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Type Document</th>
              <th>Date Created</th>
              <th>Due Date</th>
              <th>Amount</th>
              @if ($role == "Admin")
                 <th>Name User</th>
                 <th>Email User</th>
              @endif
              <th>Status</th>
              <th>Actions</th>
            </tr>        
          </thead>
          <tbody>
            @if (!empty($documents))
              @foreach ($documents as $document)                   
                <tr>
                  <td>{{ $document->id }}</td>
                  <td>{{ $document->type_doc }}</td>
                  <td>{{ $document->created_at }}</td>
                  <td>{{ $document->due_date }}</td>
                  <td>{{ $document->amount }}</td>
                  @if ($role == "Admin")
                    <td>{{ $document->user_name }}</td>
                    <td>{{ $document->email }}</td>
                  @endif 
                  <td>{{ $document->status }}</td>
                  <td align="center">           
                    <a href="/documents/{{$document->id}}" data-toggle="tooltip" data-placement="top" title="View More Info">
                      <i class="fa fa-search" aria-hidden="true" style="font-size:25px;"></i>
                    </a>
                    @if ($role == "Admin" && $document->status != "funded")
                      <a href="/documents/{{ $document->id }}/approve" data-toggle="tooltip" data-placement="top" title="Approve document">
                          <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:25px;"></i> 
                      </a>
                    @endif 
                  </td>
                </tr>
              @endforeach
            @else
              No data found
            @endif
          </tbody>
        </table>        
      </div>
    </div>
  </div>  
@endsection