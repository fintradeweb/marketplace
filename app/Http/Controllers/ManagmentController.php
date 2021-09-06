<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;

class ManagmentController extends Controller{

    public function create($email,$token){
        $records = \App\Models\Managment::consulta_todos($email, $token);
        return view('managment.index',[
          'records' => $records,
          'email' => $email,
          'token' => $token
        ]);
      }



  public function edit($id){
    $ownerships = \App\Models\Managment::consulta($id);
    return view('managment.edit')->with('ownerships', $ownerships);
  }

  public function store(Request $request){
    $result = \App\Models\Managment::registrar($request);
    if ($result->_error == 0 && $result->_msg == "ok"){
      //return redirect('/management/create/'$request->input('token').'/'.$request->input('token'));
      $records = \App\Models\Managment::consulta_todos($request->input('email'), $request->input('token'));
        return view('managment.index',[
            'records' => $records,
            'email' => $request->input('email'),
            'token' => $request->input('token'),
            'idnumber' => "",
            'percentage' =>"",
            'name' => "",
            'position' => "",
            'birthdate' => ""
        ]);
    }
    else{
      /*return redirect('/management/create/'.$request->input('email').'/'.$request->input('token'))
             ->withErrors('There was an error creating the ownership!');*/
             $records = \App\Models\Managment::consulta_todos($request->input('email'), $request->input('token'));
             return view('managment.index',[
               'records' => $records,
               'email' => $request->input('email'),
               'token' => $request->input('token'),
               'idnumber' => $request->input('idnumber'),
               'percentage' => $request->input('percentage'),
               'name' => $request->input('name'),
               'position' => $request->input('position'),
               'birthdate' => $request->input('birthdate')
             ])->withErrors('There was an error creating the ownership!');
    }
  }
   public function destroy($id)
    {
        $indiv = \App\Models\Managment::consulta($id);
        $task =  \App\Models\Managment::findOrFail($id);
        $task->delete();

       $records = \App\Models\Managment::consulta_todos($indiv[0]->email, $indiv[0]->token);
        return view('managment.index',[
            'records' => $records,
            'email' => $indiv[0]->email,
            'token' =>  $indiv[0]->token,
            'idnumber' => "",
            'percentage' =>"",
            'name' => "",
            'position' => "",
            'birthdate' => ""
        ]);
    }

  /*public function update(Request $request, $codigo){
    $result = \App\Models\Managment::actualizar($request, $codigo);
  }*/
}
