<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\CreditApproved;
use App\Models\CreditDenied;
use App\Models\NotificationSend;
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
    $creditapprovedpo = new CreditApproved;
    $creditapprovedpo->credit_line = $request->credit_line_po;
    $creditapprovedpo->advance = $request->advance_po;
    $creditapprovedpo->maximum_amount = $request->maximum_amount_po;
    $creditapprovedpo->deadline = $request->deadline_po;
    $creditapprovedpo->interest_rate = $request->interest_rate_po;
    $creditapprovedpo->type_document = "1";
    $creditapprovedpo->user_id = $request->user_id;
    $creditapprovedpo->approved_by = @Auth::user()->id;
    $rs1 = $creditapprovedpo->save();  

    $creditapprovedin = new CreditApproved;
    $creditapprovedin->credit_line = $request->credit_line_invoice;
    $creditapprovedin->advance = $request->advance_invoice;
    $creditapprovedin->maximum_amount = $request->maximum_amount_invoice;
    $creditapprovedin->deadline = $request->deadline_invoice;
    $creditapprovedin->interest_rate = $request->interest_rate_invoice;
    $creditapprovedin->type_document = "2";
    $creditapprovedin->user_id = $request->user_id;
    $creditapprovedin->approved_by = @Auth::user()->id;
    $rs2 = $creditapprovedin->save(); 

    if ($rs1 && $rs2){
      Mail::to("ffueltala@gmail.com")->send(new \App\Mail\CreditApproved($creditapprovedpo,$creditapprovedin));
      return redirect('/users/'.$request->user_id)->with('status', 'The credit was approved succesfully!');
    }
    else{
      return redirect('/credit/'.$request->user_id.'/approve')->withErrors('There was an error!');  
    }
  }

  public function storedeny(Request $request){
    $validatedData = $request->validate([
      'observation' => 'required',      
    ]);

    $creditdenied = new CreditDenied; 
    $creditdenied->observation = $request->observation;
    $creditdenied->denied_by = @Auth::user()->id;
    $creditdenied->user_id = $request->user_id;
    $rs = $creditdenied->save();

    if ($rs){
      Mail::to("ffueltala@gmail.com")->send(new \App\Mail\CreditDenied($creditdenied->observation));
      return redirect('/users/'.$request->user_id)->with('status', 'The credit was denied succesfully!');
    }
    else{
      return redirect('/credit/'.$request->user_id.'/approve')->withErrors('There was an error!');  
    }
  }

  public function storeaskmore(Request $request){
    $validatedData = $request->validate([
      'observation' => 'required',      
    ]);

    $notification = new NotificationSend; 
    $notification->description = $request->observation;
    $notification->send_by = @Auth::user()->id;
    $notification->user_id = $request->user_id;
    $notification->type_not = "askmoreinformation";
    $rs = $notification->save();

    if ($rs){
      Mail::to("ffueltala@gmail.com")->send(new \App\Mail\NotificationSend($notification->observation));
      return redirect('/users/'.$request->user_id)->with('status', 'The notification was send succesfully!');
    }
    else{
      return redirect('/credit/'.$request->user_id.'/approve')->withErrors('There was an error!');  
    }
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
    $credit_po = CreditApproved::where("user_id",$id)->where("type_document",1)->first();
    $credit_iv = CreditApproved::where("user_id",$id)->where("type_document",2)->first();    
    $user = \App\Models\User::where("id",$id)->first();
    return view('credit.edit',[
      'credit_po' => $credit_po,
      'credit_iv' => $credit_iv,
      'user' => $user
    ]);
  }

  public function update(Request $request){
    $validatedData = $request->validate([
      'id_po' => 'required|numeric',
      'credit_line_po' => 'required|numeric',
      'advance_po' => 'required|numeric',
      'maximum_amount_po' => 'required|numeric',
      'deadline_po' => 'required|numeric',
      'interest_rate_po' => 'required|numeric',
      'id_invoice' => 'required|numeric',
      'credit_line_invoice' => 'required|numeric',
      'advance_invoice' => 'required|numeric',
      'maximum_amount_invoice' => 'required|numeric',
      'deadline_invoice' => 'required|numeric',
      'interest_rate_invoice' => 'required|numeric',
    ]);
    
    /*$values_po = array("credit_line" => $request->input("credit_line_po"),
                       "advance" => $request->input("advance_po"),     
                       "maximum_amount" => $request->input("maximum_amount_po"),     
                       "deadline" => $request->input("deadline_po"),
                       "interest_rate" => $request->input("interest_rate_po"),     
                      );*/
    $values_po = new CreditApproved;
    $values_po->credit_line = $request->input("credit_line_po");
    $values_po->advance = $request->input("advance_po");
    $values_po->maximum_amount = $request->input("maximum_amount_po");
    $values_po->deadline = $request->input("deadline_po");
    $values_po->interest_rate = $request->input("interest_rate_po");

    $values_iv = new CreditApproved;
    $values_iv->credit_line = $request->input("credit_line_invoice");
    $values_iv->advance = $request->input("advance_invoice");
    $values_iv->maximum_amount = $request->input("maximum_amount_invoice");
    $values_iv->deadline = $request->input("deadline_invoice");
    $values_iv->interest_rate = $request->input("interest_rate_invoice");

    /*$values_iv = array("credit_line" => $request->input("credit_line_invoice"),
                       "advance" => $request->input("advance_invoice"),     
                       "maximum_amount" => $request->input("maximum_amount_invoice"),     
                       "deadline" => $request->input("deadline_invoice"),
                       "interest_rate" => $request->input("interest_rate_invoice"),     
                      );*/
    $rs1 = CreditApproved::update_amount($values_po,$request->input("id_po"));
    $rs2 = CreditApproved::update_amount($values_iv,$request->input("id_invoice"));

    if ($rs1 && $rs2){
      Mail::to("ffueltala@gmail.com")->send(new \App\Mail\CreditEdited($values_po,$values_iv));
      return redirect('/users')->with('status', 'The credit was modified succesfully!');
    }
    else{
      return redirect('/users')->withErrors('There was an error!');  
    }
  }

  public function destroy($id){
        //
  }
}
