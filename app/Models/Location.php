<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class Location extends Model {


  public static function get_countries() {
    $result = DB::select("call Get_countries()");
    return $result;
  }
  public static function get_states($country_id) {
    $result = DB::select("call Get_states(?)",[$country_id]);
    return $result;
  }
  public static function get_cities($state_id) {
    $result = DB::select("call Get_cities(?)",[$state_id]);
    return $result;
  }


}
