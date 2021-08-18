<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class Bankinformation extends Model {

  protected $table = 'bankinformations';

  public static function consulta($id) {
    $managments = DB::select("call Get_bankinformation(?)",[$id]);
    return $managments;
  }
  public static function consulta_todos($email,$token) {
    $result = DB::select("call Get_bankinformation_client_user(?,?)",[$email,$token]);
    return $result;
  }

  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;

    $result = DB::select('call Insert_bankinformation(?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('email'),
                    $request->input('bank_name'),
                    $request->input('account_same_swift'),
                    $request->input('account_number'),
                    $request->input('aba_routing'),
                    $request->input('bank_adress'),
                    $request->input('telephone'),
                    $request->input('account_officer'),
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

      $result = DB::select('call Update_bankinformation(?,?,?,?,?,?)',
                  [
                        $codigo,
                        $request->input('bank_name'),
                        $request->input('account_same_swift'),
                        $request->input('account_number'),
                        $request->input('aba_routing'),
                        $request->input('bank_adress'),
                        $request->input('telephone'),
                        $request->input('account_officer'),
                        $msg,
                        $error
                  ]);
      return $result[0];
  }

}
