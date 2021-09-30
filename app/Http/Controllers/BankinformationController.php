<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;

class BankinformationController extends Controller{

  public function create(){
    return view('bankinformation.create');
  }

  public function edit($id){
    $bankinformation = \App\Models\Bankinformation::consulta($id);
    return view('bankinformation.edit')->with('bankinformation', $bankinformation);
  }

  public function store(Request $request){
    try{
      $validator = Validator::make($request->all(), [
        'bank_name' => 'required|max:255',
        'adress' => 'required|max:255',
        'account_same_swift' => 'required|max:255',
        'account_number' => 'required|max:255',
        'aba_routing' => 'required|max:255',
        'bank_adress' => 'required|max:255',
        'telephone' => 'required|max:255',
        'account_officer' => 'nullable|max:255'
      ]);

      $indiv = new \App\Models\Bankinformation();
      $indiv->bank_name =  $request->input('bank_name');
      $indiv->adress =  $request->input('adress');
      $indiv->account_same_swift =  $request->input('account_same_swift');
      $indiv->account_number =  $request->input('account_number');
      $indiv->aba_routing =  $request->input('aba_routing');
      $indiv->bank_adress =  $request->input('bank_adress');
      $indiv->telephone =  $request->input('telephone');
      $indiv->account_officer = $request->input('account_officer');

      if ($validator->fails()) {
        throw new \Exception("validator");
      }
      $bankinfo = \App\Models\Bankinformation::consulta_todos( $request->input('email'),  $request->input('token'));        
      if (isset($bankinfo[0][0]) && $bankinfo[0][0]->existe==0){
        $result = \App\Models\Bankinformation::registrar($request);        
      }
      else{
        $result = \App\Models\Bankinformation::actualizar($request, $bankinfo[1][0]->id);
      }
      
      if($result->_error==1){
        throw new \Exception($result->_msg);                      
      }
      else{        
        $indiv = \App\Models\Certification::consulta_todos( $request->input('email'),  $request->input('token'));
        $indiv_new = new \App\Models\Certification();
        if($indiv[0][0]->existe==0){
          return view('certification.create',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv' =>  $indiv_new
          ]);
        }
        else{
          return view('certification.edit',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv' =>  $indiv[1][0]
          ]);
        }        
      }
    }
    catch(\Exception $e){  
      $errors = ($e->getMessage() == "validator") ? $validator : $e->getMessage();    
      return view('bankinformation.create',[
        'email' =>$request->input('email'),
        'token' =>  $request->input('token'),
        'indiv'=>$indiv
      ])->withErrors($errors);
    }
  }

  public function update(Request $request, $codigo){
    try{
      $validator = Validator::make($request->all(), [
        'bank_name' => 'required|max:255',
        'adress' => 'required|max:255',
        'account_same_swift' => 'required|max:255',
        'account_number' => 'required|max:255',
        'aba_routing' => 'required|max:255',
        'bank_adress' => 'required|max:255',
        'telephone' => 'required|max:255',
        'account_officer' => 'nullable|max:255'
      ]);

      $indiv = new \App\Models\Bankinformation();
      $indiv->bank_name =  $request->input('bank_name');
      $indiv->account_same_swift =  $request->input('account_same_swift');
      $indiv->account_number =  $request->input('account_number');
      $indiv->aba_routing =  $request->input('aba_routing');
      $indiv->bank_adress =  $request->input('bank_adress');
      $indiv->adress =  $request->input('adress');
      $indiv->telephone =  $request->input('telephone');
      $indiv->account_officer = $request->input('account_officer');

      if ($validator->fails()) {
        throw new \Exception("validator");  
      }
      $result = \App\Models\Bankinformation::actualizar($request, $codigo);
      if($result->_error==1){
        throw new \Exception($result->_msg);            
      }
      else{
        $indiv = \App\Models\Certification::consulta_todos( $request->input('email'),  $request->input('token'));
        $indiv_new = new \App\Models\Certification();
        if($indiv[0][0]->existe==0){
          return view('certification.create',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv' =>  $indiv_new
          ]);
        }
        else{
          return view('certification.edit',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv' =>  $indiv[1][0]
          ]);
        }
      }
    }
    catch(\Exception $e){     
      $errors = ($e->getMessage() == "validator") ? $validator : $e->getMessage(); 
      return view('bankinformation.create',[
        'email' =>$request->input('email'),
        'token' =>  $request->input('token'),
        'indiv'=>$indiv
      ])->withErrors($errors);
    }      
  }

}