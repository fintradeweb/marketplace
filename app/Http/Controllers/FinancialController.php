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
        $vacio = [];
        if($indiv[0][0]->existe==0){
            return view('financial.create',[
                'email' =>$request->input('email'),
                'token' =>  $request->input('token')
            ]);
        }
        else{
            return view('financial.index',[
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
    $validator = Validator::make($request->all(), [
        'avg_montky_sales' => 'required',
        'ams_how_clients' => 'required',
        'estimated_montly_financing' => 'required',
        'emf_number_clients' => 'required'
      ]);

      if ($validator->fails()) {
        return view('financial.create',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token')
        ])->withErrors($validator);
      }

    $result = \App\Models\Financial::registrar($request);
    var_dump($result);
    if($result->_error==1){
        return view('financial.create',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token')
        ])->withErrors('There was an error creating the financial request!');
    }
    else{
        $indiv = \App\Models\Financial::consulta_todos( $request->input('email'),  $request->input('email'));
        return view('financial.index',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('email'),
            'indiv' =>  $indiv[1][0]
        ]);
    }


  }

    public function update(Request $request, $codigo)
    {

        $result = \App\Models\Financial::actualizar($request, $codigo);
    }
}
