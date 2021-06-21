<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class c_user{

}

class InformationController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  
  
  public function index(Request $request)
  {
    try{
      if (empty($request->input('token'))){
        throw new \Exception("Error, token is empty.");
        
      }
      $client = \App\Models\Client::valida_token($request->input('token'));
      if($client->error == 1){
        $call = new c_user();
        $call->email = "correo_prueba@market.com";
        $call->password = "abcdeef";
        $call->created_at = "29/05/2021 09:09";
        Mail::to("mfj_correo@yahoo.com")->send(new \App\Mail\MarketReceived($call));
        throw new \Exception($client->msg);
      }
      $usuario = \App\Models\Client::existe_usuario($request->input('txt_email'));
      $band = 0;
      if($usuario->bussinesinformation>0){
          $band = 1;
          return view('businessinformation.edit')->with('user', $usuario->bussinesinformation);
      }
      if($band == 0){
        return view('businessinformation.create')
              ->with('nombre',$request->input('nombre'))
              ->with('txt_email',$request->input('txt_email'))
              ->with('txt_taxid',$request->input('txt_taxid'))
              ->with('txt_datecompany',$request->input('txt_datecompany'))
              ->with('txt_contactname',$request->input('txt_contactname'))
              ->with('txt_zipcode',$request->input('txt_zipcode'))
              ->with('txt_typebussiness',$request->input('txt_typebussiness'))
              ->with('txt_country',$request->input('txt_country'))
              ->with('txt_state',$request->input('txt_state'))
              ->with('txt_address',$request->input('txt_address'))
              ->with('txt_city',$request->input('txt_city'))
              ->with('txt_secretaryname',$request->input('txt_secretaryname'))
              ->with('txt_dba',$request->input('txt_dba'))
              ->with('txt_cellphone',$request->input('txt_cellphone'))
              ;
      }

      $error = ""; 
    }
    catch(Exception $e){
      $error = $e->getMessage();
    }
    return view('information.index', [
      'error' => $error
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() 
  {
    //
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
        //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) 
  {
        //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
        //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
        //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
        //
  }
}
