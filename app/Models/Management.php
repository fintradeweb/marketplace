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

    $result = DB::select('call Insert_managment(?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('name'),
                    $request->input('email'),
                    $request->input('idno'),
                    $request->input('position'),
                    $request->input('percentage'),
                    $request->input('birthday'),
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
