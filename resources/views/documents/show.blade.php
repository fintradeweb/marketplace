@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="row col-md-10 p-4">
      <div class="col-md-6"><h5>Consult Document to Finance</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/documents"class="btn btn-primary">Return</a>
      </div>
    </div>
    <div class="col-md-10">
      <div class="card">
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <h5 class="card-title">Status:</h5>
              <p class="card-text">{{$document->status}}</p>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Type Document:</h5>
              <p class="card-text">{{$document->type_doc}}</p>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Url Document:</h5>
              <a href="//{{$document->url_doc}}" target="blank" >Show Document</a>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Created Date:</h5>
              <p class="card-text">{{$document->creation_date}}</p>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Due Date:</h5>
              <p class="card-text">{{$document->due_date}}</p>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Amount:</h5>
              <p class="card-text">{{$document->amount}}</p>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Name User:</h5>
              <p class="card-text">{{$user->name}}</p>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Email User:</h5>
              <p class="card-text">{{$user->email}}</p>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Telephone User:</h5>
              <p class="card-text">{{$bussiness->phone}}</p>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Client:</h5>
              <p class="card-text">{{$client->name}}</p>
            </li>
            <li class="list-group-item">
              <h5 class="card-title">Ruc/Tax:</h5>
              <p class="card-text">{{$bussiness->ruc_tax}}</p>
            </li>

          </ul>
        </div>
      </div>
  </div>
</div>
@endsection
