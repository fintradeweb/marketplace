@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('businessinformation.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" value="{{ $nombre }}" placeholder="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="txt_email" class="form-control" value="{{ $txt_email }}" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tax Id:</strong>
                <input type="text" name="txt_taxid" class="form-control" value="{{ $txt_taxid }}" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Datecompany:</strong>
                <input type="text" name="txt_datecompany" class="form-control" value="{{ $txt_datecompany }}" placeholder="">
            </div>
        </div>

        

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>contactname:</strong>
                <input type="text" name="txt_contactname" class="form-control" value="{{ $txt_contactname }}" placeholder="">
            </div>
        </div>

       

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>zipcode:</strong>
                <input type="text" name="txt_zipcode" class="form-control" value="{{ $txt_zipcode }}" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>typebussiness:</strong>
                <input type="text" name="txt_typebussiness" class="form-control" value="{{ $txt_typebussiness }}" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>phone:</strong>
                <input type="text" name="txt_phone" class="form-control" value="{{ $txt_phone }}" placeholder="">
            </div>
        </div>

      

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>country:</strong>
                <input type="text" name="txt_country" class="form-control" value="{{ $txt_country }}" placeholder="">
            </div>
        </div>

        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>state:</strong>
                <input type="text" name="txt_state" class="form-control" value="{{ $txt_state }}" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>city:</strong>
                <input type="text" name="txt_city" class="form-control" value="{{ $txt_city }}" placeholder="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Adress:</strong>
                <input type="text" name="txt_address" class="form-control" value="{{ $txt_address }}" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>president:</strong>
                <input type="text" name="txt_president" class="form-control" value="{{ $txt_president }}" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>website:</strong>
                <input type="text" name="website" class="form-control" value="{{ $txt_website }}" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>dba:</strong>
                <input type="text" name="txt_dba" class="form-control" value="{{ $txt_dba }}" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>cellphone:</strong>
                <input type="text" name="txt_cellphone" class="form-control" value="{{ $txt_cellphone }}" placeholder="">
            </div>
        </div>
        <input type="hidden" id="token" name="token" value="{{ $token }}">

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection