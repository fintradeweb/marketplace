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
    $validator = Validator::make($request->all(), [
        'bank_name' => 'required',
        'account_same_swift' => 'required',
        'account_number' => 'required',
        'aba_routing' => 'required',
        'bank_adress' => 'required',
        'telephone' => 'required',
        'account_officer' => 'required'
    ]);

    $indiv = new \App\Models\Bankinformation();
    $indiv->bank_name =  $request->input('bank_name');
    $indiv->account_same_swift =  $request->input('account_same_swift');
    $indiv->account_number =  $request->input('account_number');
    $indiv->aba_routing =  $request->input('aba_routing');
    $indiv->bank_adress =  $request->input('bank_adress');
    $indiv->telephone =  $request->input('telephone');
    $indiv->account_officer = $request->input('account_officer');

    if ($validator->fails()) {

        return view('bankinformation.create',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv'=>$indiv

        ])->withErrors($validator);
    }
    $result = \App\Models\Bankinformation::registrar($request);
    if($result->_error==1){
        return view('bankinformation.create',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv'=>$indiv
        ])->withErrors('There was an error creating the Bank information!');
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

    public function update(Request $request, $codigo)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'account_same_swift' => 'required',
            'account_number' => 'required',
            'aba_routing' => 'required',
            'bank_adress' => 'required',
            'telephone' => 'required',
            'account_officer' => 'required'
        ]);

        $indiv = new \App\Models\Bankinformation();
        $indiv->bank_name =  $request->input('bank_name');
        $indiv->account_same_swift =  $request->input('account_same_swift');
        $indiv->account_number =  $request->input('account_number');
        $indiv->aba_routing =  $request->input('aba_routing');
        $indiv->bank_adress =  $request->input('bank_adress');
        $indiv->telephone =  $request->input('telephone');
        $indiv->account_officer = $request->input('account_officer');

        if ($validator->fails()) {

            return view('bankinformation.create',[
                'email' =>$request->input('email'),
                'token' =>  $request->input('token'),
                'indiv'=>$indiv

            ])->withErrors($validator);
        }
        $result = \App\Models\Bankinformation::actualizar($request, $codigo);
        if($result->_error==1){
            return view('bankinformation.create',[
                'email' =>$request->input('email'),
                'token' =>  $request->input('token'),
                'indiv'=>$indiv
            ])->withErrors('There was an error creating the bank information!');
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
}
