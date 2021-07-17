@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="row col-md-12 p-4">
        <div class="col-md-6"><h5>List of Clients</h5></div>
        <div class="col-md-6 ml-auto text-right">
          <a type="button" class="btn btn-primary" href="/clients/create">New Client</a>
        </div>
      </div>
      <div class="col-md-12">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Id</th>
              <th>Date created</th>
              <th>Name</th>
              <th>Token</th>
              <th>Email</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>        
          </thead>
          <tbody>
            @foreach ($clients as $client)              
              <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->created_at }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->token }}</td>
                <td>{{ $client->email }}</td>
                @if ($client->active)
                  <td>Active</td>
                @else
                  <td>Inactive</td>
                @endif                
                <td><a href="/clients/{{$client->id}}">Ver</a> / <a href="clients/{{$client->id}}/edit">Editar</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>        
      </div>
    </div>
  </div>  
@endsection