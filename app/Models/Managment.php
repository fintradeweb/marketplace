<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class Managment extends Model {

  protected $table = 'managements';

  public static function consulta($id) {
    $managments = DB::select("call Get_managments(?)",[$id]);
    return $managments;
  }
  public static function consulta_todos($email,$token) {
    $result = DB::select("call Get_managments_client_user(?,?)",[$email,$token]);
    return $result;
  }

  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;


    $result = DB::select('call Insert_managment(?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('name'),
                    $request->input('email'),
                    $request->input('idnumber'),
                    $request->input('position'),
                    $request->input('percentage'),
                    $request->input('birthdate'),
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

      $result = DB::select('call Update_managment(?,?,?,?,?,?,?,?)',
                  [
                        $codigo,
                        $request->input('name'),
                        $request->input('idno'),
                        $request->input('position'),
                        $request->input('percentage'),
                        $request->input('birthday'),
                        $msg,
                        $error

                  ]);
      return $result[0];
  }

}
