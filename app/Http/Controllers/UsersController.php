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
      $users = \App\Models\User::getUsersByRol(3);
      $rol = "1";
    }
    else{
      $users = \App\Models\User::getUsersByRol(3);
      $rol = "3";
    }
    return view('users.index', [
      'users' => $users,
      'rol' => $rol,
      'css_borrow' => 'primary',
      'css_admin' => 'success',
      'css_sadmin' => 'success'
    ]);
  }

  public function getRol($type){
    $users = \App\Models\User::getUsersByRol($type);
    $rol = "1";
    $css_borrow = ($type==3) ? "primary" : "success";
    $css_admin = ($type==2) ? "primary" : "success";
    $css_sadmin = ($type==1) ? "primary" : "success";
    return view('users.index', [
      'users' => $users,
      'rol' => $rol,
      'css_borrow' => $css_borrow,
      'css_admin' => $css_admin,
      'css_sadmin' => $css_sadmin
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
    $user = \App\Models\User::credit_info($id); 
    //$business = (isset($user[0][0]) && !empty($user[0][0])) ? $user[0][0] : '';   
    //$management = (isset($user[1][0]) && !empty($user[1][0])) ? $user[1][0] : '';
    //$financial = (isset($user[2][0]) && !empty($user[2][0])) ? $user[2][0] : '';   
    //$bank = (isset($user[3][0]) && !empty($user[3][0])) ? $user[3][0] : ''; 
    //$certification = (isset($user[4][0]) && !empty($user[4][0])) ? $user[4][0] : '';
    $business = '';   
    $management = '';
    $financial = '';   
    $bank = ''; 
    $certification = '';
    echo "<pre>";
    var_dump($user);
    echo "</pre>";                    
    return view('users.show', [
      'business' => $business,
      'management' => $management,
      'financial' => $financial,
      'bank' => $bank,
      'certification' => $certification
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
