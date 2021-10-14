<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditApproved extends Model{

  protected $table = 'credit_approved';

  public static function update_amount($request,$id) {

    $result = DB::select('call Update_approved_values(?,?,?,?,?,?,@error,@msg)',
                 [
                   $id,
                   (empty($request->input('credit_line'))) ? 0 : $request->input('credit_line'),
                   (empty($request->input('advance'))) ? 0 : $request->input('advance'),
                   (empty($request->input('maximum_amount'))) ? 0 : $request->input('maximum_amount'),
                   (empty($request->input('deadline'))) ? 0 : $request->input('deadline'),
                   (empty($request->input('interest_rate'))) ? 0 : $request->input('interest_rate')
                 ]);
     return $result[0];
 }
}
