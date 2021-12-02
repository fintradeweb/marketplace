<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
