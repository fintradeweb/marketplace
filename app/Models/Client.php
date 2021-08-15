<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;


class Client extends Model 
{
  protected $table = 'clients';
  
  public static function todos() {
     $clients = DB::select("call get_clients_all();");
     return $clients;
  }

  public static function individual($id) {
    $clients = DB::select("call Get_client_item(?)",[$id]);
    return $clients[0];
  }

  public static function valida_token($s_token) {
    $client = DB::select("call Get_client_token(?)",[$s_token]);
    return $client[0];
  }
  
  public static function existe_usuario($s_email) {
    $usuario = DB::select("call Get_existe_user(?)",[$s_email]);
    return $usuario[0];
  }

  public static function registrar($request) {
    $error="0";
    $msg= "";
    $result = DB::select('call Insert_client(?,?,?,?)',
                [
                    $request->input('name'),
                    $request->input('email'),
                    $error,
                    $msg
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
      
      $result = DB::select('call Update_client(?,?,?,?,?,?)',
                  [
                      $codigo,
                      $request->input('name'),
                      $request->input('email'),
                      $active,
                      $error,
                      $msg
                  ]);
      return $result[0];
    }

}
