<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;

class FinancialController extends Controller{

  public function index(Request $request){
    $indiv = \App\Models\Financial::consulta_todos( $request->input('email'),  $request->input('token'));
    $indiv_new = new \App\Models\Financial();
    if($indiv[0][0]->existe==0){
      return view('financial.create',[
        'email' =>$request->input('email'),
        'token' =>  $request->input('token'),
        'indiv' =>  $indiv_new
      ]);
    }
    else{
      return view('financial.edit',[
        'email' =>$request->input('email'),
        'token' =>  $request->input('token'),
        'indiv' =>  $indiv[1][0]
      ]);
    }
  }

  public function edit($id){
    $financial = \App\Models\Financial::consulta($id);
    return view('financial.edit')->with('financial', $financial);
  }

  public function store(Request $request){
    $indiv = new \App\Models\Financial();
    $po_finance = "";
    $in_finance = "";
    if(!empty($request->input('po_finance'))){
    $po_finance =" checked";
    }
    if(!empty($request->input('in_finance'))){
    $in_finance = " checked";
    }
    $indiv->avg_montky_sales =  $request->input('avg_montky_sales');
    $indiv->ams_how_clients =  $request->input('ams_how_clients');
    $indiv->estimated_montly_financing =  $request->input('estimated_montly_financing');
    $indiv->emf_number_clients =  $request->input('emf_number_clients');
    $indiv->rf_when_with_whom =  $request->input('rf_when_with_whom');
    $indiv->cip_when_with_whom =  $request->input('cip_when_with_whom');
    $indiv->has_applicant =  $request->input('has_applicant');
    $indiv->po_finance =  $po_finance;
    $indiv->in_finance = $in_finance;
    $indiv->lawsuits_pending = $request->input('lawsuits_pending');
    $indiv->receivable_finance = $request->input('receivable_finance');
    $indiv->credit_insurance_policy = $request->input('credit_insurance_policy');
    $indiv->declared_bank_ruptcy = $request->input('declared_bank_ruptcy');
    try{
      $validator = Validator::make($request->all(), [
        'avg_montky_sales' => 'required',
        'ams_how_clients' => 'required',
        'estimated_montly_financing' => 'required',
        'emf_number_clients' => 'required',
        'rf_when_with_whom' => 'nullable',
        'cip_when_with_whom' => 'nullable',
        'po_finance' => 'required_without:in_finance',
        'in_finance' => 'required_without:po_finance'
      ]);
      /*$has_applicant = "";
      $po_finance = "";
      $in_finance = "";
      $lawsuits_pending = "";
      $receivable_finance = "";
      $credit_insurance_policy = "";
      $declared_bank_ruptcy = "";

      if(!empty($request->input('has_applicant'))){
        $has_applicant = " checked";
      }
      if(!empty($request->input('po_finance'))){
        $po_finance =" checked";
      }
      if(!empty($request->input('in_finance'))){
        $in_finance = " checked";
      }
      if(!empty($request->input('lawsuits_pending'))){
        $lawsuits_pending = " checked";
      }
      if(!empty($request->input('receivable_finance'))){
        $receivable_finance = " checked";
      }
      if(!empty($request->input('credit_insurance_policy'))){
        $credit_insurance_policy = " checked";
      }
      if(!empty($request->input('declared_bank_ruptcy'))){
        $declared_bank_ruptcy = " checked";
      }    */

      if ($validator->fails()) {
        throw new \Exception("validator");
      }
      $finaninfo = \App\Models\Financial::consulta_todos( $request->input('email'),  $request->input('token'));
      if (isset($finaninfo[0][0]) && $finaninfo[0][0]->existe==0){
        $result = \App\Models\Financial::registrar($request);
      }
      else{
        $result = \App\Models\Financial::actualizar($request, $finaninfo[1][0]->id);
      }
      if($result->_error==1){
        throw new \Exception($result->_msg);
      }
      else{
        $indiv = \App\Models\Bankinformation::consulta_todos( $request->input('email'),  $request->input('token'));
        $indiv_new = new \App\Models\Bankinformation();
        if($indiv[0][0]->existe==0){
          return view('bankinformation.create',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv' =>  $indiv_new
          ]);
        }
        else{
          return view('bankinformation.edit',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv' =>  $indiv[1][0]
          ]);
        }
      }
    }
    catch(\Exception $e){
      $errors = ($e->getMessage() == "validator") ? $validator : $e->getMessage();
      return view('financial.create',[
        'email' =>$request->input('email'),
        'token' =>  $request->input('token'),
        'indiv'=>$indiv
      ])->withErrors($errors);
    }
  }

  public function update(Request $request, $codigo){
    try{
      $validator = Validator::make($request->all(), [
        'avg_montky_sales' => 'required|max:255',
        'ams_how_clients' => 'required|max:255',
        'estimated_montly_financing' => 'required|max:255',
        'emf_number_clients' => 'required|max:255',
        'rf_when_with_whom' => 'nullable|max:255',
        'cip_when_with_whom' => 'nullable|max:255',
        'po_finance' => 'required_without:in_finance',
        'in_finance' => 'required_without:po_finance'
      ]);
      $po_finance = "";
      $in_finance = "";
      if(!empty($request->input('po_finance'))){
        $po_finance =" checked";
      }
      if(!empty($request->input('in_finance'))){
        $in_finance = " checked";
      }
      /*$has_applicant = "";
      $po_finance = "";
      $in_finance = "";
      $lawsuits_pending = "";
      $receivable_finance = "";
      $credit_insurance_policy = "";
      $declared_bank_ruptcy = "";

      if(!empty($request->input('has_applicant'))){
        $has_applicant = " checked";
      }
      if(!empty($request->input('po_finance'))){
        $po_finance =" checked";
      }
      if(!empty($request->input('in_finance'))){
        $in_finance = " checked";
      }
      if(!empty($request->input('lawsuits_pending'))){
        $lawsuits_pending = " checked";
      }
      if(!empty($request->input('receivable_finance'))){
        $receivable_finance = " checked";
      }
      if(!empty($request->input('credit_insurance_policy'))){
        $credit_insurance_policy = " checked";
      }
      if(!empty($request->input('declared_bank_ruptcy'))){
        $declared_bank_ruptcy = " checked";
      }*/
      $indiv = new \App\Models\Financial();
      $indiv->avg_montky_sales =  $request->input('avg_montky_sales');
      $indiv->ams_how_clients =  $request->input('ams_how_clients');
      $indiv->estimated_montly_financing =  $request->input('estimated_montly_financing');
      $indiv->emf_number_clients =  $request->input('emf_number_clients');
      $indiv->rf_when_with_whom =  $request->input('rf_when_with_whom');
      $indiv->cip_when_with_whom =  $request->input('cip_when_with_whom');
      $indiv->has_applicant =  $request->input('has_applicant');
      $indiv->po_finance =  $request->input('po_finance');
      $indiv->in_finance = $request->input('in_finance');
      $indiv->lawsuits_pending = $request->input('lawsuits_pending');
      $indiv->receivable_finance = $request->input('receivable_finance');
      $indiv->credit_insurance_policy = $request->input('credit_insurance_policy');
      $indiv->declared_bank_ruptcy = $request->input('declared_bank_ruptcy');


      if ($validator->fails()) {
        throw new \Exception("validator");
      }
      $result = \App\Models\Financial::actualizar($request, $codigo);
      if($result->_error==1){
        throw new \Exception($result->_msg);
      }
      else{
        $indiv = \App\Models\Bankinformation::consulta_todos( $request->input('email'),  $request->input('token'));
        $indiv_new = new \App\Models\Bankinformation();
        if($indiv[0][0]->existe==0){
          return view('bankinformation.create',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv' =>  $indiv_new
          ]);
        }
        else{
          return view('bankinformation.edit',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv' =>  $indiv[1][0]
          ]);
        }
      }
    }
    catch(\Exception $e){
      $errors = ($e->getMessage() == "validator") ? $validator : $e->getMessage();
      return view('financial.create',[
        'email' =>$request->input('email'),
        'token' =>  $request->input('token'),
        'indiv'=>$indiv
      ])->withErrors($errors);
    }
  }

}
