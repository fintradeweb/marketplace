@extends('layouts.app')
@section('content')

@if (session('status'))
 <div class="row justify-content-center">
   <div class="col-md-8 col-lg-8 col-sm-12">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     <div class="alert alert-success">
      {{ session('status') }}
     </div>     
   </div>
 </div>    
@endif

@if ($errors->any())
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-8 col-sm-12">
      <div class="alert alert-danger" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>       
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>        
      </div>
    </div>
  </div>  
@endif

<div class="container">
  <div class="row justify-content-center">  
    <div class="row col-md-12 p-4">
      <div class="col-md-6"><h5>Request Financing</h5></div>
      <div class="col-md-6 ml-auto text-right">
        <a href="/"class="btn btn-primary">Return</a>
      </div>
    </div> 

    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <form action="{{ route('financing.store') }}" method="POST" id="frm_financingstore">                                        
            @csrf       
            <div class="col-xs-12 col-sm-12 col-md-12 text-center"> 
              <table class="table table-hover table-bordered">
                <thead>
                  <th>Type Document</th>
                  <th>File</th>
                  <th>Creation Date</th>
                  <th>Due Date</th>
                  <th>Amount</th>
                  <th>Select</th>
                </thead>
                <tbody>
                  @if (!empty($documents))                
                    @foreach ($documents as $key=>$document)                                  
                      <tr>
                        <td>{{$document->documento}}</td>
                        <td><a href="https://{{$document->url}}" target="_blank">{{$document->url}}</a></td>
                        <td>{{$document->created_at}}</td>
                        <td>{{substr($document->validity,0,10)}}</td>
                        <td>{{$document->amount}}</td>
                        <td>
                          <div class="form-check-inline">
                            <input type="checkbox" name="chk_select[]" id="chk_select_{{$key}}" class="form-check-input chk_lg" value="{{json_encode($document)}}">
                          </div>
                        </td>
                      </tr>
                    @endforeach 
                  @else 
                    There is not information 
                  @endif
                </tbody>
              </table>                               
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="reset" class="btn btn-secondary" id="btnreset">Reset</button>
              <button type="submit" class="btn btn-primary" id="btn_save">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection