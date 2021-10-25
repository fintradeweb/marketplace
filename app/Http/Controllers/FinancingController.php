<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinancingController extends Controller{
    
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $documents = \App\Models\Apinsa::get_documents("supermercado@nsa-exchange.com");  
    return view("financing.index",["documents"=>$documents->documents]);
  }

  public function create(){
        //
  }

  public function store(Request $request){
    $validatedData = $request->validate([
      'chk_select' => 'required'
    ]);    
    
    return redirect('/home')->with('status', 'The financing was saved succesfully!');                  
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
