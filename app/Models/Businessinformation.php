<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;


class Businessinformation extends Model 
{
  protected $table = null;
  
  
  public static function registrar($request) {
    $error="0";
    $msg= "";
    $result = DB::select('call Insert_businessinformation(?,?,?,?)',
                [
                    $request->input('name'),
                    $request->input('email'),
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
