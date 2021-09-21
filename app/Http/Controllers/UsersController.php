<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;
use DB;

class UsersController extends Controller{
  
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    if(@Auth::user()->hasRole('SuperAdmin')){
      $users = \App\Models\User::getUsersByRol(0);
      $rol = "1";
    }
    else{
      $users = \App\Models\User::getUsersByRol(3);
      $rol = "3";
    }
    return view('users.index', [
      'users' => $users,
      'rol' => $rol
    ]);
  }
  
  public function create(){
    return view('users.create');
  }
    
  public function store(Request $request){
    $validatedData = $request->validate([
      'name' => 'required|unique:users|max:255',
      'email' => 'required|unique:users|email',
      'password' => 'required|min:6|max:20',
      'rol_id' => 'required'      
    ]);
    $result = \App\Models\User::create_user_admin_super($request);       
    if ($result[0]->_error == 0 && $result[0]->_msg == "ok"){
      $user = \App\Models\User::where('email',$request->input('email'))->first();          
      $user->password = $result[1];
      Mail::to("ffueltala@gmail.com")->send(new \App\Mail\MarketUser($user));
      return redirect('/users')->with('status', 'The user was created succesfully!');
    }else{
      return redirect('/users/create')->withErrors('There was an error creating the user!');  
    }
  }

  public function show($id){
    //$user = \App\Models\User::where('id',$id)->first();
    $user = DB::table('users')->join('businessinformations', 'businessinformations.user_id', '=', 'users.id')
                              //->join('managements', 'managements.user_id', '=', 'users.id')   
                              //->join('certificationauthorizations', 'certificationauthorizations.user_id', '=', 'users.id')
                              ->where('users.id',$id)
                              ->first();  
    var_dump($user);                               
    return view('users.show', [
      'user' => $user
    ]);  
  }

  public function edit($id){
    $user = \App\Models\User::where("id",$id)->first();       
    $user->role = DB::table('model_has_roles')->where('model_id',$id)->first();
    return view('users.edit')->with('user', $user);
  }

  public function update(Request $request, $id){
    $validatedData = $request->validate([
      'name' => 'required|unique:users,name,'.$id.'|max:255',
      'email' => 'required|unique:users,email,'.$id.'|email',
      'password' => 'nullable|min:6|max:20'
    ]);    
    $result = \App\Models\User::update_user_admin_super($request, $id);     
    if ($result->_error == 0 && $result->_msg == "ok"){
      return redirect('/users')->with('status', 'The user was edited succesfully!');
    }
    else{
      return redirect('/users/'.$id.'/edit')->withErrors('There was an error editing the user!');
    }  
  }

  public function destroy($id){
    //
  }
}
