<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class Certification extends Model {

  protected $table = 'certificationauthorizations';

  public static function consulta($id) {
    $managments = DB::select("call Get_certification(?)",[$id]);
    return $managments;
  }
  public static function consulta_todos($email,$token) {
    $result = DB::select("call Get_certification_client_user(?,?)",[$email,$token]);
    return $result;
  }

  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;
    if(!empty($request->input('approved_agreed'))){
        $approved_agreed = 1;
    }

    $result = DB::select('call Insert_certification(?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('email'),
                    $approved_agreed,
                    $request->input('name'),
                    $request->input('title'),
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
      if(!empty($request->input('approved_agreed'))){
        $approved_agreed = 1;
      }

      $result = DB::select('call Update_certification(?,?,?,?,?,?)',
                  [
                        $codigo,
                        $approved_agreed,
                        $request->input('name'),
                        $request->input('title'),
                        $msg,
                        $error
                  ]);
      return $result[0];
  }

}
