<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller{
    
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){   
    if(@Auth::user()->hasRole('SuperAdmin')){      
      return view("homesuperadmin",[
        "name" => @Auth::user()->name
      ]);
    }
    elseif(@Auth::user()->hasRole('Admin')){  
      return view("homeadmin",[
        "name" => @Auth::user()->name
      ]);
    }
    else{      
      $creditapproved = \App\Models\CreditApproved::where("user_id",@Auth::user()->id)->get();
      $documents = \App\Models\DocumentFinancing::where("user_id",@Auth::user()->id)->get();
      return view("home",[
        "documents" => $documents,
        "creditapproved" => $creditapproved, 
        "name" => @Auth::user()->name
      ]);
    }    
  }
}
