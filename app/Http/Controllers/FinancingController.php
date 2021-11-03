<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentFinancing;
use Auth;

class FinancingController extends Controller{
    
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $documents = \App\Models\Apinsa::get_documents("supermercado@nsa-exchange.com"); 
    /*$documents = new \stdClass();
    $documents->success = 1;
    $documents->documents = array(0 => (object)array("documento" => "PO",
                                                       "url" => "b2b.nsa-exchange.com/downloadpdf/INV-1633881935-123",
                                                       "amount" => "0.00",
                                                       "validity" => "2021-10-13 16:05:35",
                                                       "created_at" => "2021-10-10",
                                                       "owner" => (object)array("company_name" => "Proveedor",
                                                                        "email" => "freddyjosemarin@gmail.com",
                                                                        "year_established" => "2019",
                                                                        "contact_name" => "Eduardo Lecuna",
                                                                        "postal_code" => "6203",
                                                                        "phone_number" => "04123445566",
                                                                        "website" => "",
                                                                        "state" => "Distrito Federal",
                                                                        "address" => "La candelaria, ccs",
                                                                        "city" => "Caracas"
                                                                        )
                                                      ),
                                            1 => (object)array("documento" => "PO",
                                                       "url" => "b2b.nsa-exchange.com/downloadpdf/INV-1633880368-122",
                                                       "amount" => "0.00",
                                                       "validity" => "2021-10-13 15:39:28",
                                                       "created_at" => "2021-10-10",
                                                       "owner" => (object)array("company_name" => "Proveedor",
                                                                        "email" => "freddyjosemarin@gmail.com",
                                                                        "year_established" => "2019",
                                                                        "contact_name" => "Eduardo Lecuna",
                                                                        "postal_code" => "6203",
                                                                        "phone_number" => "04123445566",
                                                                        "website" => "",
                                                                        "state" => "Distrito Federal",
                                                                        "address" => "La candelaria, ccs",
                                                                        "city" => "Caracas"
                                                                        )
                                                      )
                                           ); */
    return view("financing.index",["documents"=>$documents->documents]);
  }

  public function create(){
        //
  }

  public function store(Request $request){
    $validatedData = $request->validate([
      'chk_select' => 'required'
    ]);            
    foreach($request->chk_select as $document){      
      $array = json_decode($document);
      $objdocument = new DocumentFinancing;
      $objdocument->aditional = $document;
      $objdocument->type_doc = $array->documento;
      $objdocument->url_doc = $array->url;
      $objdocument->amount = $array->amount;
      $objdocument->creation_date = $array->created_at;
      $objdocument->due_date = $array->validity;
      $objdocument->user_id = @Auth::user()->id;
      $objdocument->created_at = date("Y-m-d H:i:s");
      $rs = $objdocument->save();
    }
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
