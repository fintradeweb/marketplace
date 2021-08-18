<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class Financial extends Model {

  protected $table = 'financialrequests';

  public static function consulta($id) {
    $managments = DB::select("call Get_financial(?)",[$id]);
    return $managments;
  }

  public static function registrar($request) {
    $error=0;
    $msg= "";
    $id = 0;
    $has_applicant = 0;
    if(!empty($request->input('has_applicant'))){
        $has_applicant = 1;
    }
    $po_finance = 0;
    if(!empty($request->input('po_finance'))){
        $po_finance = 1;
    }
    $in_finance = 0;
    if(!empty($request->input('in_finance'))){
        $in_finance = 1;
    }
    $lawsuits_pending = 0;
    if(!empty($request->input('lawsuits_pending'))){
        $lawsuits_pending = 1;
    }
    $receivable_finance = 0;
    if(!empty($request->input('receivable_finance'))){
        $receivable_finance = 1;
    }
    $credit_insurance_policy = 0;
    if(!empty($request->input('credit_insurance_policy'))){
        $credit_insurance_policy = 1;
    }
    $declared_bank_ruptcy = 0;
    if(!empty($request->input('declared_bank_ruptcy'))){
        $declared_bank_ruptcy = 1;
    }


    $result = DB::select('call Insert_financial(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('avg_montky_sales'),
                    $request->input('ams_how_clients'),
                    $has_applicant,
                    $po_finance,
                    $in_finance,
                    $lawsuits_pending,
                    $receivable_finance,
                    $credit_insurance_policy,
                    $declared_bank_ruptcy,
                    $request->input('estimated_montly_financing'),
                    $request->input('emf_number_clients'),
                    $request->input('rf_when_with_whom'),
                    $request->input('cip_when_with_whom'),
                    $request->input('email'),
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
        $has_applicant = 0;
        if(!empty($request->input('has_applicant'))){
            $has_applicant = 1;
        }
        $po_finance = 0;
        if(!empty($request->input('po_finance'))){
            $po_finance = 1;
        }
        $in_finance = 0;
        if(!empty($request->input('in_finance'))){
            $in_finance = 1;
        }
        $lawsuits_pending = 0;
        if(!empty($request->input('lawsuits_pending'))){
            $lawsuits_pending = 1;
        }
        $receivable_finance = 0;
        if(!empty($request->input('receivable_finance'))){
            $receivable_finance = 1;
        }
        $credit_insurance_policy = 0;
        if(!empty($request->input('credit_insurance_policy'))){
            $credit_insurance_policy = 1;
        }
        $declared_bank_ruptcy = 0;
        if(!empty($request->input('declared_bank_ruptcy'))){
            $declared_bank_ruptcy = 1;
        }

         $result = DB::select('call Update_financial(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                  [
                        $codigo,
                        $request->input('avg_montky_sales'),
                        $request->input('ams_how_clients'),
                        $has_applicant,
                        $po_finance,
                        $in_finance,
                        $lawsuits_pending,
                        $receivable_finance,
                        $credit_insurance_policy,
                        $declared_bank_ruptcy,
                        $request->input('estimated_montly_financing'),
                        $request->input('emf_number_clients'),
                        $request->input('rf_when_with_whom'),
                        $request->input('cip_when_with_whom'),
                        $msg,
                        $error
                  ]);
      return $result[0];
  }

}
