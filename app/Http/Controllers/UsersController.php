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
      $users = \App\Models\User::getUsersByRol();
    }
    else{
      $users = \App\Models\User::getUsersByRol();
    }
    var_dump($users);
    exit;
    return view('users.index', [
        'users' => $users
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
