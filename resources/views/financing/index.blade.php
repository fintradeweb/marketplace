@extends('layouts.app')
@section('content')

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
          <form action="" method="POST" id="frm_creditapproved">                                        
            @csrf       
            <div class="col-xs-12 col-sm-12 col-md-12 text-center"> 
              <table width="100%" border="1">
                <thead>
                  <th>Type Document</th>
                  <th>File</th>
                  <th>Amount</th>
                  <th>Select</th>
                </thead>
                <tbody>
                  @foreach ($documents as $key=>$document)                  
                    <tr>
                      <td>{{$document->documento}}</td>
                      <td>{{$document->url}}</td>
                      <td>{{$document->amount}}</td>
                      <td>
                        <div class="form-check-inline">
                        <input type="checkbox" name="chk_select[]" id="chk_select_{{$key}}" class="form-check-input chk_lg">
                        </div>
                      </td>
                    </tr>
                  @endforeach 
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