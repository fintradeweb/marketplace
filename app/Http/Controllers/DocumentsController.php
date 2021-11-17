<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentsController extends Controller{

  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $status = \App\Models\DocumentFinancing::getStatus();     
    $documents = \App\Models\DocumentFinancing::get_documents_financing();
    return view('documents.index', [
      'documents' => $documents,
      'status' => $status,
    ]);
  }

  public function search(Request $request){
    $filterstatus = ($request->input("status") == "All") ? "" : $request->input("status");
    $date_start = (empty($request->input("date_start"))) ? "" : $request->input("date_start");
    $date_end = (empty($request->input("date_end"))) ? "" : $request->input("date_end");
    $ruc = (empty($request->input("ruc"))) ? "" : $request->input("ruc");    
    $documents = \App\Models\DocumentFinancing::get_documents_financing($filterstatus,$date_start,$date_end,$ruc);
    $status = \App\Models\DocumentFinancing::getStatus();
    return view('documents.index', [
      'documents' => $documents,      
      'status' => $status
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
