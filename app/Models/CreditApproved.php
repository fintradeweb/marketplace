<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CreditApproved extends Model{

  protected $table = 'credit_approved';

  public static function update_amount($values,$id) {
    $result = DB::select('call Update_approved_values(?,?,?,?,?,?,@error,@msg)',
                [
                  $id,
                  (empty($values->credit_line)) ? 0 : $values->credit_line,
                  (empty($values->advance)) ? 0 : $values->advance,
                  (empty($values->maximum_amount)) ? 0 : $values->maximum_amount,
                  (empty($values->deadline)) ? 0 : $values->deadline,
                  (empty($values->interest_rate)) ? 0 : $values->interest_rate
                ]);
    return $result[0];
 }

}
