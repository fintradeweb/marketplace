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
    $rol = (@Auth::user()->hasRole('SuperAdmin')) ? "1" : "2";
    $users = \App\Models\User::getUsersByRol(3);  
    $status = \App\Models\User::getStatus();
    return view('users.index', [
      'users' => $users,
      'rol' => $rol,
      'status' => $status,
      'css_borrow' => 'primary',
      'css_admin' => 'success',
      'css_sadmin' => 'success'
    ]);
  }

  public function getRol($type){
    $users = \App\Models\User::getUsersByRol($type,"","","","","");
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

  public function search(Request $request){
    $filterstatus = ($request->input("status") == "All") ? "" : $request->input("status");
    $date_start = (empty($request->input("date_start"))) ? "" : $request->input("date_start");
    $date_end = (empty($request->input("date_end"))) ? "" : $request->input("date_end");
    $ruc = (empty($request->input("ruc"))) ? "" : $request->input("ruc");
    $rol = (@Auth::user()->hasRole('SuperAdmin')) ? "1" : "2";
    $users = \App\Models\User::getUsersByRol(3,$filterstatus,$date_start,$date_end,$ruc);  
    $status = \App\Models\User::getStatus();
    return view('users.index', [
      'users' => $users,
      'rol' => $rol,
      'status' => $status,
      'css_borrow' => 'primary',
      'css_admin' => 'success',
      'css_sadmin' => 'success'
    ]);
  }
  
  public function create(){
    $companies = \App\Models\Company::consulta_todos();
    return view('users.create',['companies' => $companies]);
  }

  public function store(Request $request){
    $validatedData = $request->validate([
      'name' => 'required|unique:users|max:255',
      'email' => 'required|unique:users|email',
      'password' => 'required|min:6|max:20',
      'rol_id' => 'required'
    ]);
    if ($request->input('rol_id') == 2 && empty($request->input('company_id'))){
      return redirect('/users/create')->withErrors('The company is required');
    }
    $result = \App\Models\User::create_user_admin_super($request);
    if ($result[0]->_error == 0 && $result[0]->_msg == "ok"){
      $user = \App\Models\User::where('email',$request->input('email'))->first();
      $user->password = $result[1];
      Mail::to("ffueltala@gmail.com")->send(new \App\Mail\MarketUser($user));
      return redirect('/users')->with('status', 'The user was created succesfully!');
    }else{
      return redirect('/users/create')->withErrors($result[0]->_msg);
    }
  }

  public function show($id){
    $user = \App\Models\User::credit_info($id);
    $business = (isset($user[0][0]) && !empty($user[0][0])) ? $user[0][0] : '';
    $management = (isset($user[1]) && !empty($user[1])) ? $user[1] : '';
    $financial = (isset($user[2][0]) && !empty($user[2][0])) ? $user[2][0] : '';
    $bank = (isset($user[3][0]) && !empty($user[3][0])) ? $user[3][0] : '';
    $certification = (isset($user[4][0]) && !empty($user[4][0])) ? $user[4][0] : '';
    $credit_status = $user[5][0]->credit_status;
    return view('users.show', [
      'iduser' => $id,
      'business' => $business,
      'management' => $management,
      'financial' => $financial,
      'bank' => $bank,
      'certification' => $certification,
      'credit_status' => $credit_status
    ]);
  }

  public function edit($id){
    $user = \App\Models\User::where("id",$id)->first();
    $user->role = DB::table('model_has_roles')->where('model_id',$id)->first();
    $companies = \App\Models\Company::consulta_todos();
    if ($user->role->role_id == 2){
      $user->company = DB::table('usercompany')->where('user_id',$id)->first();
    }
    return view('users.edit', ['user'=> $user, 'companies' => $companies]);
  }

  public function update(Request $request, $id){
    $validatedData = $request->validate([
      'name' => 'required|unique:users,name,'.$id.'|max:255',
      'email' => 'required|unique:users,email,'.$id.'|email',
      'password' => 'nullable|min:6|max:20'
    ]);
    $role = DB::table('model_has_roles')->where('model_id',$id)->first();
    if ($role->role_id == 2 && empty($request->input('company_id'))){
      return redirect('/users/'.$id.'/edit')->withErrors('The company is required');
    }
    $result = \App\Models\User::update_user_admin_super($request, $id);
    if ($result->_error == 0 && $result->_msg == "ok"){
      return redirect('/users')->with('status', 'The user was edited succesfully!');
    }
    else{
      return redirect('/users/'.$id.'/edit')->withErrors($result->_msg);
    }
  }

  public function destroy($id){
    //
  }
}
