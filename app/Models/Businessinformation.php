<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class Businessinformation extends Model {

  protected $table = 'businessinformations';

  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;
    $clave = Hash::make("MARKET" .  Str::random(5) . "PLACE" . date('Y-m-d H:i:s'));

    $result = DB::select('call Insert_businessinformation(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
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
                    $msg,
                    $id
                ]);
      return $result[0];
  }

  public static function actualizar($request,$codigo){
      $error="0";
      $msg= "";

     // $clave = Hash::make("MARKET" .  Str::random(5) . "PLACE" . date('Y-m-d H:i:s'));

      $result = DB::select('call Update_businessinformation(?,?,?,?,?,?)',
                  [
                        $codigo,
                        $request->input('name'),
                        $request->input('txt_email'),
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
                        $error,
                        $msg
                  ]);
      return $result[0];
  }

}
