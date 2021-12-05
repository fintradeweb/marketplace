<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Auth;

class DocumentsController extends Controller{

  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    if(@Auth::user()->hasRole('Admin')){
      $role = "Admin";
      $documents = \App\Models\DocumentFinancing::get_documents_financing(); 
    }
    if(@Auth::user()->hasRole('Client')){
      $role = "Client";
      $documents = \App\Models\DocumentFinancing::get_documents_financing('','','','',@Auth::user()->id); 
    }
    $status = \App\Models\DocumentFinancing::getStatus();     
    return view('documents.index', [
      'documents' => $documents,
      'status' => $status,
      'role' => $role
    ]);
  }

  public function search(Request $request){
    $filterstatus = ($request->input("status") == "All") ? "" : $request->input("status");
    $date_start = (empty($request->input("date_start"))) ? "" : $request->input("date_start");
    $date_end = (empty($request->input("date_end"))) ? "" : $request->input("date_end");
    $ruc = (empty($request->input("ruc"))) ? "" : $request->input("ruc"); 
    if(@Auth::user()->hasRole('Admin')){
      $role = "Admin";   
      $documents = \App\Models\DocumentFinancing::get_documents_financing($filterstatus,$date_start,$date_end,$ruc);
    }
    if(@Auth::user()->hasRole('Client')){
      $role = "Client";
      $documents = \App\Models\DocumentFinancing::get_documents_financing($filterstatus,$date_start,$date_end,'',@Auth::user()->id);
    }
    $status = \App\Models\DocumentFinancing::getStatus();
    return view('documents.index', [
      'documents' => $documents,      
      'status' => $status,
      'role' => $role
    ]);
  }

  public function approve($id){
    $document = \App\Models\DocumentFinancing::where("id",$id)->first();
    $user = \App\Models\User::where("id",$document->user_id)->first();
    $credit = \App\Models\CreditApproved::where("user_id",$user->id)->get();
    return view('documents.approve', [
      'document' => $document,
      'user' => $user,
      'credit' => $credit
    ]);
  } 

  public function reject($id){
    $document = \App\Models\DocumentFinancing::where("id",$id)->first();
    $user = \App\Models\User::where("id",$document->user_id)->first();
    $credit = \App\Models\CreditApproved::where("user_id",$user->id)->get();
    return view('documents.reject', [
      'document' => $document,
      'user' => $user,
      'credit' => $credit
    ]);
  } 

  public function storereject(Request $request){
    $validatedData = $request->validate([
      'observation' => 'required',
    ]);

    $historic = new \App\Models\DocumentFinancingHistoric;
    $historic->observation = $request->observation;
    $historic->lender_id = @Auth::user()->id;
    $historic->document_id = $request->document_id;
    $historic->status = 'denied';
    $rs = $historic->save();

    if ($rs){
      $document = \App\Models\DocumentFinancing::find($request->document_id);
      $document->status = 'denied';
      $document->save();

      $user = \App\Models\User::where('id',$request->user_id)->first();
      Mail::to($user->email)->send(new \App\Mail\DocumentDenied($historic->observation));
      return redirect('/documents')->with('status', 'The document was denied succesfully!');
    }
    else{
      return redirect('/documents/'.$request->document_id.'/approve')->withErrors('There was an error!');
    }
  }

  public function storeapprove(Request $request){
    try{
      DB::beginTransaction();
      $validatedData = $request->validate([
        'amount' => 'required|numeric',
      ]);

      $document = \App\Models\DocumentFinancing::where("id",$request->document_id)->first();
      if ($document->type_doc == "PO"){
        $type_document = 1;
        $credit = \App\Models\CreditApproved::where("user_id",$request->user_id)
                                            ->where("type_document",1)->first();
        $acum_amount = \App\Models\DocumentFinancingHistoric::where("user_id",$request->user_id)                                    ->where("type_document",1)
                                              ->where("status","funded")
                                              ->get()->sum("amount");
      } 
      if ($document->type_doc == "Invoice"){
        $type_document = 2;
        $credit = \App\Models\CreditApproved::where("user_id",$request->user_id)
                                            ->where("type_document",2)->first();
        $acum_amount = \App\Models\DocumentFinancingHistoric::where("user_id",$request->user_id)                                    ->where("type_document",2)
                                              ->where("status","funded")
                                              ->get()->sum("amount");  
      } 

      $credit_line = $credit["credit_line"]; 
      if ($request->amount > $credit["maximum_amount"]){
        throw new \Exception("The maximun amount per transaction is greater than amount"); 
      }  

      $total = $acum_amount + $request->amount;
      if ($total > $credit_line){
        throw new \Exception("The amount is greater than credit line"); 
      }

      $historic = new \App\Models\DocumentFinancingHistoric;
      $historic->lender_id = @Auth::user()->id;
      $historic->document_id = $request->document_id;
      $historic->status = 'funded';
      $historic->amount = $request->amount;
      $historic->type_document = $type_document;
      $historic->user_id = $request->user_id;
      $rs = $historic->save();

      if (!$rs){
        throw new \Exception("There was an error!");  
      }

      $document = \App\Models\DocumentFinancing::find($request->document_id);
      $document->status = 'funded';
      $rs = $document->save();
      if (!$rs){
        throw new \Exception("There was an error!");  
      }

      $act_total = $credit_line - $request->amount;
      $rs = \App\Models\CreditApproved::where("user_id",$request->user_id)
                                      ->where("type_document",$type_document)
                                      ->update(["credit_line"=>$act_total]);

      DB::commit();
      $user = \App\Models\User::where('id',$request->user_id)->first();
      Mail::to($user->email)->send(new \App\Mail\DocumentApproved($historic->amount));
      return redirect('/documents/')->with('status', 'The document was approved succesfully!');

    }
    catch(\Exception $e){
      DB::rollBack();
      $errors = ($e->getMessage() == "validator") ? $validator : $e->getMessage();
      return redirect('/documents/'.$request->document_id.'/approve')->withErrors($errors);
    }

  }

  public function create(){
        //
  }

  public function store(Request $request){
        //
  }

  public function show($id){
    $document = \App\Models\DocumentFinancing::where("id",$id)->first();
    $user = \App\Models\User::where("id",$document->user_id)->first();
    $bussiness = \App\Models\Businessinformation::where("user_id",$document->user_id)->first();
    $client = \App\Models\Client::where("id",$bussiness->client_id)->first();
    return view('documents.show', [
      'document' => $document,
      'user' => $user,
      'bussiness' => $bussiness,
      'client' => $client
    ]); 
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
