<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;


class Businessinformation extends Model 
{
  protected $table = null;
  
  
  
  public static function registrar($request) {
    $error=0;
    $msg= "";
    $clave = Hash::make("MARKET" .  Str::random(5) . "PLACE" . date('Y-m-d H:i:s'));
    /*
                                IN _name varchar(255),
                                IN _email varchar(255),
                                IN _clave varchar(255),
                                IN _taxid varchar(255),
                                IN _datecompany varchar(255),
                                IN _contactname varchar(255),
                                IN _zipcode varchar(255),
                                IN _typebussiness varchar(255),
                                IN _phone varchar(255),
                                IN _president varchar(255),
                                IN _country varchar(255),
                                IN _state varchar(255),
                                IN _city varchar(255),
                                IN _address varchar(255),
                                IN _website varchar(255),
                                IN _secretaryname varchar(255),
                                IN _dba varchar(255),
                                IN _cellphone varchar(255),
                                IN _token varchar(255),
                                OUT _msg varchar(255),
                                OUT _error tinyint 
    */
    $result = DB::select('call Insert_businessinformation(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('name'),
                    $request->input('txt_email'),
                    $clave,
                    $request->input('txt_taxid'),
                    $request->input('txt_datecompany'),
                    $request->input('txt_contactname'),
                    $request->input('txt_zipcode'),
                    $request->input('txt_typebussiness'),
                    $request->input('txt_phone'),
                    $request->input('txt_president'),
                    $request->input('txt_country'),
                    $request->input('txt_state'),
                    $request->input('txt_city'),
                    $request->input('txt_address'),
                    $request->input('txt_website'),
                    $request->input('txt_secretaryname'),
                    $request->input('txt_dba'),
                    $request->input('txt_cellphone'),
                    $request->input('token'),
                    $error,
                    $msg
                ]);
      return $result[0];
  }
  public static function actualizar($request,$codigo){
      $error="0";
      $msg= "";
      $active = 0;
      if(!empty($request->input('active'))){
          $active = 1;
      }
      
      $result = DB::select('call Update_businessinformation(?,?,?,?,?,?)',
                  [
                      $codigo,
                      $request->input('name'),
                      $request->input('email'),
                      $active,
                      $error,
                      $msg
                  ]);
      return $result[0];
    }

}
