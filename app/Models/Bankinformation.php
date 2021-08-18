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

  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;

    $result = DB::select('call Insert_bankinformation(?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('txt_email'),
                    $request->input('txt_bank_name'),
                    $request->input('txt_account_same_swift'),
                    $request->input('txt_account_number'),
                    $request->input('txt_aba_routing'),
                    $request->input('txt_bank_adress'),
                    $request->input('txt_telephone'),
                    $request->input('txt_account_officer'),
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
                        $request->input('txt_bank_name'),
                        $request->input('txt_account_same_swift'),
                        $request->input('txt_account_number'),
                        $request->input('txt_aba_routing'),
                        $request->input('txt_bank_adress'),
                        $request->input('txt_telephone'),
                        $request->input('txt_account_officer'),
                        $msg,
                        $error
                  ]);
      return $result[0];
  }

}
