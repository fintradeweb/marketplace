<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class Management extends Model {

  protected $table = 'managments';

  public static function consulta($id) {
    $managments = DB::select("call Get_managments(?)",[$id]);
    return $managments;
  }

  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;

    $result = DB::select('call Insert_managment(?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('txt_email'),
                    $request->input('txt_name'),
                    $request->input('txt_idno'),
                    $request->input('txt_percentage'),
                    $request->input('txt_position'),
                    $request->input('txt_birthday'),
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

      $result = DB::select('call Update_managment(?,?,?,?,?,?)',
                  [
                        $codigo,
                        $request->input('txt_email'),
                        $request->input('txt_name'),
                        $request->input('txt_idno'),
                        $request->input('txt_percentage'),
                        $request->input('txt_datecompany'),
                        $request->input('txt_position'),
                        $request->input('txt_birthday'),
                        $error,
                        $msg
                  ]);
      return $result[0];
  }

}
