<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use DB;

class Apinsa extends Model {


  public static function get_documents($email) {
    try
    {
        $result = DB::select("call Get_api_nsa()");
        $url_s = $result[0]->descripcion . $email;
        $response = Http::get($url_s);
        return $response->object();
    } catch (\Exception $ex)
    {
        return $ex;
    }

  }

}
