<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
    //
  }
    
  public function store(Request $request){
    //
  }

  public function show($id){
    //
  }

  public function edit($id){
    //
  }

  public function update(Request $request, $id){
    //
  }

  public function destroy($id){
    //
  }
}
