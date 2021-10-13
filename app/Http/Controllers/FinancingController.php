<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinancingController extends Controller{
    
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $documents = \App\Models\Apinsa::get_documents("supermercado@nsa-exchange.com"); 
    var_dump($documents);   
    return view("financing.index",["documents"=>$documents->documents]);
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
