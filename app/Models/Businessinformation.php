<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class Businessinformation extends Model {

  protected $table = 'businessinformations';

  public static function consulta($id) {
    $result = DB::select("call Get_businessinformation(?)",[$id]);
    return $result;
  }

  public static function consulta_todos($email,$token) {
    $result = DB::select("call Get_businessinformation_client_user(?,?)",[$email,$token]);
    return $result;
  }
  
  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;

    $clave = Hash::make("MARKET" .  Str::random(5) . "PLACE" . date('Y-m-d H:i:s'));

    $result = DB::select('call Insert_businessinformation(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('name'),
                    $request->input('email'),
                    $clave,
                    $request->input('taxid'),
                    $request->input('datecompany'),
                    $request->input('contactname'),
                    $request->input('zipcode'),
                    $request->input('typebussiness'),
                    $request->input('phone'),
                    $request->input('president'),
                    $request->input('country'),
                    $request->input('state'),
                    $request->input('city'),
                    $request->input('address'),
                    $request->input('website'),
                    $request->input('secretaryname'),
                    $request->input('dba'),
                    $request->input('cellphone'),
                    $request->input('token'),
                    $msg,
                    $error,
                    $id
                ]);
    return $result[0];
  }

  public static function actualizar($request,$codigo){
      $error="0";
      $msg= "";

     // $clave = Hash::make("MARKET" .  Str::random(5) . "PLACE" . date('Y-m-d H:i:s'));

      $result = DB::select('call Update_businessinformation(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                  [
                        $codigo,
                        $request->input('name'),
                        $request->input('email'),
                        $request->input('taxid'),
                        $request->input('datecompany'),
                        $request->input('contactname'),
                        $request->input('zipcode'),
                        $request->input('typebussiness'),
                        $request->input('phone'),
                        $request->input('president'),
                        $request->input('country'),
                        $request->input('state'),
                        $request->input('city'),
                        $request->input('address'),
                        $request->input('website'),
                        $request->input('secretaryname'),
                        $request->input('dba'),
                        $request->input('cellphone'),
                        $msg,
                        $error

                  ]);
      return $result[0];
  }

}
