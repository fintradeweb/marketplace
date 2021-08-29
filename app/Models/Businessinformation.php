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
    return $result[0];
  }

  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;
    $clave2 = "MARKET" .  Str::random(5) . "PLACE" . date('His');

    $clave = Hash::make($clave2);

    $is_buyer = "0";
    if(!empty($request->input('is_buyer'))){
        $is_buyer = $request->input('is_buyer');
    }
    $is_seller = "0";
    if(!empty($request->input('is_buyer'))){
        $is_seller = $request->input('is_buyer');
    }

    $result = DB::select('call Insert_businessinformation(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('name'),
                    $request->input('email'),
                    $clave,
                    $request->input('ruc_tax'),
                    $request->input('date_company'),
                    $request->input('contact_name'),
                    $request->input('zip'),
                    $request->input('type_business'),
                    $request->input('phone'),
                    $request->input('president_name'),
                    $request->input('country_id'),
                    $request->input('state_id'),
                    $request->input('city_id'),
                    $request->input('address'),
                    $request->input('website'),
                    $request->input('secretary_name'),
                    $request->input('dba'),
                    $request->input('cell_phone'),
                    $request->input('token'),
                    $is_buyer,
                    $is_seller,
                    $msg,
                    $error,
                    $id
                ]);
    $result[1] =  $clave2;
    return $result;
  }

  public static function actualizar($request,$codigo){
      $error="0";
      $msg= "";

      $is_buyer = "0";
      if(!empty($request->input('is_buyer'))){
        $is_buyer = $request->input('is_buyer');
      }
      $is_seller = "0";
      if(!empty($request->input('is_buyer'))){
        $is_seller = $request->input('is_buyer');
      }



      $result = DB::select('call Update_businessinformation(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                  [
                        $codigo,
                        $request->input('name'),
                        $request->input('email'),
                        $request->input('ruc_tax'),
                        $request->input('date_company'),
                        $request->input('contact_name'),
                        $request->input('zip'),
                        $request->input('type_business'),
                        $request->input('phone'),
                        $request->input('president_name'),
                        $request->input('country_id'),
                        $request->input('state_id'),
                        $request->input('city_id'),
                        $request->input('address'),
                        $request->input('website'),
                        $request->input('secretary_name'),
                        $request->input('dba'),
                        $request->input('cell_phone'),
                        $is_buyer,
                        $is_seller,
                        $msg,
                        $error

                  ]);
      return $result[0];
  }

}
