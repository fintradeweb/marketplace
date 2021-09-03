<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class ManagmentController extends Controller{

  public function create($email,$token){
    $records = \App\Models\Managment::consulta_todos($email, $token);
    return view('ownership.index',[
      'records' => $records,
      'email' => $email,
      'token' => $token
    ]);
  }

  public function edit($id){
    $ownerships = \App\Models\Managment::consulta($id);
    return view('ownership.edit')->with('ownerships', $ownerships);
  }

  public function store(Request $request){
    $result = \App\Models\Managment::registrar($request);
    if ($result->_error == 0 && $result->_msg == "ok"){
      return redirect('/management/create/'.$request->input('email').'/'.$request->input('token'));
    }
    else{
      return redirect('/management/create/'.$request->input('email').'/'.$request->input('token'))
             ->withErrors('There was an error creating the ownership!');  
    }   
  }

  public function update(Request $request, $codigo){
    $result = \App\Models\Managment::actualizar($request, $codigo);
  }
}
