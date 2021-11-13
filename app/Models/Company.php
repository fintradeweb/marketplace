<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class Managment extends Model {

  protected $table = 'company';

  public static function consulta($id) {
    $managments = DB::select("call Get_company_item(?)",[$id]);
    return $managments;
  }
  public static function consulta_todos() {
    $result = DB::select("call Get_companies()");
    return $result;
  }

  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;


    $result = DB::select('call Insert_company(?,?,?,@msg,@error,@id)',
                [
                    $request->input('name'),
                    $request->input('description'),
                    $request->input('address')
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

      $result = DB::select('call Update_company(?,?,?,?,?,@msg,@error)',
                  [
                        $codigo,
                        $request->input('name'),
                        $request->input('description'),
                        $request->input('address'),
                        $active

                  ]);
      return $result[0];
  }

}
