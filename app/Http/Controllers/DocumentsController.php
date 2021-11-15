<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentsController extends Controller{

  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $documents = \App\Models\DocumentFinancing::get_documents_financing();
    return view('documents.index', [
      'documents' => $documents
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
