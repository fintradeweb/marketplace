<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller{
    
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $tags = array();
    if(@Auth::user()->hasRole('SuperAdmin')){
      $view = "homesuperadmin";       
    }
    elseif(@Auth::user()->hasRole('Admin')){
      $view = "homeadmin";
    }
    else{
      $creditapproved = \App\Models\CreditApproved::where("user_id",@Auth::user()->id);
      $tags["creditapproved"] = $creditapproved;
      var_dump($tags);
      $view = "home";  
    }
    return view($view,[$tags]);
  }
}
