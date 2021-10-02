<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditApproved;
use Auth;

class CreditController extends Controller{
    
  public function __construct(){
    $this->middleware('auth');
  }

  public function approve($userid){
    $userinfo = \App\Models\User::where("id",$userid)->first();   
    return view('credit.approve',[
      'user' => $userinfo,
      
    ]);  
  }

  public function deny($userid){
    $userinfo = \App\Models\User::where("id",$userid)->first();   
    return view('credit.deny',[
      'user' => $userinfo,
     
    ]);    
  }

  public function askmore($userid){
    $userinfo = \App\Models\User::where("id",$userid)->first();
    return view('credit.askmore',[
      'user' => $userinfo
    ]);    
  }

  public function storeapprove(Request $request){
    $validatedData = $request->validate([
      'credit_line_po' => 'required|numeric',
      'advance_po' => 'required|numeric',
      'maximum_amount_po' => 'required|numeric',
      'deadline_po' => 'required|numeric',
      'interest_rate_po' => 'required|numeric',
      'credit_line_invoice' => 'required|numeric',
      'advance_invoice' => 'required|numeric',
      'maximum_amount_invoice' => 'required|numeric',
      'deadline_invoice' => 'required|numeric',
      'interest_rate_invoice' => 'required|numeric',
    ]);
    $creditapproved = new CreditApproved;
    $creditapproved->credit_line = $request->credit_line_po;
    $creditapproved->advance = $request->advance_po;
    $creditapproved->maximum_amount_ = $request->maximum_amount_po;
    $creditapproved->deadline = $request->deadline_po;
    $creditapproved->interest_rate = $request->interest_rate_po;
    $creditapproved->type_document = "1";
    $creditapproved->user_id = $request->user_id;
    $creditapproved->approved_by = @Auth::user()->id;
    //$creditapproved->credit_line = $request->name;
    //$creditapproved->save(); 
  }

  public function storedeny(Request $request){
    $validatedData = $request->validate([
      'observation' => 'required',      
    ]);
  }

  public function index(){
        //
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
