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
        //
  }

  public function update(Request $request, $id){
        //
  }

  public function destroy($id){
        //
  }
}
