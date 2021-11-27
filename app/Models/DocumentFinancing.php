<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class DocumentFinancing extends Model{

  protected $table = 'document_financing';

  public static function getStatus(){
    $result = DB::select('call Get_document_financing_states()');
    return $result;
  }

  public static function get_documents_financing($status='',$date_start='',$date_end='',$ruc='', $userid=0){
    $result = DB::select('call Get_document_financing(?,?,?,?,?)',
                    [
                        $status,
                        $date_start,
                        $date_end,
                        $ruc,
                        $userid
                    ]);
    return $result;
  }

}
