<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;

class CertificationController extends Controller{

  public function index(Request $request){
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

  public function create(){
    return view('certification.create');
  }

  public function edit($id){
    $certification = \App\Models\Certification::consulta($id);
    return view('certification.edit')->with('certification', $certification);
  }

  public function store(Request $request){
    try{
      $validator = Validator::make($request->all(), [
          'approved_agreed' => 'required',
          'name' => 'required',
          'title' => 'required',
          'emf_number_clients'
      ]);
      $approved_agreed="";
      if(!empty($request->input('approved_agreed'))){
          $approved_agreed =" checked";
      }
      $indiv = new \App\Models\Certification();
      $indiv->approved_agreed =  $approved_agreed;
      $indiv->name =  $request->input('name');
      $indiv->title =  $request->input('title');
      if ($validator->fails()) {
        throw new \Exception($validator);
      }
      $result = \App\Models\Certification::registrar($request);
      if($result->_error==1){
        throw new \Exception('There was an error saving the Certification information!');
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
      return view('certification.create',[
        'email' =>$request->input('email'),
        'token' =>  $request->input('token'),
        'indiv'=>$indiv
      ])->withErrors($e->getMessage());
    }      
  }

  public function update(Request $request, $codigo){
    try{
      $validator = Validator::make($request->all(), [
        'approved_agreed' => 'required',
        'name' => 'required',
        'title' => 'required',
        'emf_number_clients'
      ]);
      $approved_agreed="";
      if(!empty($request->input('approved_agreed'))){
        $approved_agreed =" checked";
      }
      $indiv = new \App\Models\Certification();
      $indiv->approved_agreed =  $approved_agreed;
      $indiv->name =  $request->input('name');
      $indiv->title =  $request->input('title');
      if ($validator->fails()) {
        throw new \Exception($validator);
      }
      $result = \App\Models\Certification::actualizar($request, $codigo);
      if($result->_error==1){
        throw new \Exception('There was an error creating the Certification!');        
      }
      else{
        return view('certification.final');     
      }
    }
    catch(\Exception $e){   
      return view('certification.create',[
        'email' =>$request->input('email'),
        'token' =>  $request->input('token'),
        'indiv'=>$indiv
      ])->withErrors($e->getMessage());
    }
  }
}
