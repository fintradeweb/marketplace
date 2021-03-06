<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InformationController extends Controller{
      
  public function index(Request $request){    
>>>>>>> fernanda
    try{
      if (empty($request->input('token'))){
        throw new \Exception("Error, token is empty.");
        
      }
      $client = \App\Models\Client::valida_token($request->input('token'));      
      if ($client->error == 1){
        throw new \Exception("Error, company not registered in marketplace.");
      }      

      $usuario = \App\Models\User::existe_usuario($request->input('txt_email'));         
            
      if($usuario->existe == 1){ 
        $user = \App\Models\User::where('email',$request->input('txt_email'))->first();
        $business = \App\Models\Businessinformation::where('user_id',$user->id)->first(); 

        return view('information.edit')->with('user', $user)
                                       ->with('business',$business)                                       
                                       ->with('token',$request->input('token'));
      }
      else{           
        return view('information.create')->with('name',$request->input('nombre'))
                                         ->with('token',$request->input('token'))
                                         ->with('email',$request->input('txt_email'))
                                         ->with('ruc_tax',$request->input('txt_taxid'))
                                         ->with('date_company',$request->input('txt_datecompany'))
                                         ->with('contact_name',$request->input('txt_contactname'))
                                         ->with('zip',$request->input('txt_zipcode'))
                                         ->with('type_business',$request->input('txt_typeofbusiness'))
                                         ->with('country_id',$request->input('txt_country'))
                                         ->with('state_id',$request->input('txt_state'))
                                         ->with('address',$request->input('txt_address'))
                                         ->with('city_id',$request->input('txt_city'))        
                                         ->with('dba',$request->input('txt_dba'))
                                         ->with('phone',$request->input('txt_phone'))
                                         ->with('website',$request->input('txt_website'))
                                         ->with('president_name',$request->input('txt_presidentname'))
                                         ->with('cell_phone',$request->input('txt_cellphone'))
                                         ->with('secretary_name',$request->input('txt_secretaryname'));
      }
      $error = ""; 
    }
    catch(\Exception $e){
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
  public function create(){
    //
  }
  
  public function store(Request $request){
    $error = "";   
    
    try{               
      $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'email' => 'required|unique:users|email',
        'ruc_tax' => 'required|unique:businessinformations|max:255',
        'date_company' => 'required|date_format:Y-m-d',
        'contact_name' => 'required|max:255',
        'president_name' => 'required|max:255',
        'type_business' => 'required|max:255',
        'phone' => 'required|max:255',
        'country_id' => 'required|max:255',
        'city_id' => 'required|max:255',
        'state_id' => 'required|max:255',
        'zip' => 'required|max:255',
        'address' => 'required|max:255',
        'cell_phone' => 'nullable|max:255',
        'website' => 'nullable|max:255',
        'dba' => 'nullable|max:255',        
        'secretary_name' => 'nullable|max:255',
      ]);
            
      if ($validator->fails()) {
        return view('information.create')->with('name',$request->input('name'))  
                                         ->with('token',$request->input('token'))     
                                         ->with('email',$request->input('email'))
                                         ->with('ruc_tax',$request->input('ruc_tax'))
                                         ->with('date_company',$request->input('date_company'))
                                         ->with('contact_name',$request->input('contact_name'))
                                         ->with('zip',$request->input('zip'))
                                         ->with('type_business',$request->input('type_business'))
                                         ->with('country_id',$request->input('country_id'))
                                         ->with('state_id',$request->input('state_id'))
                                         ->with('address',$request->input('address'))
                                         ->with('city_id',$request->input('city_id'))
                                         ->with('dba',$request->input('dba'))
                                         ->with('phone',$request->input('phone'))
                                         ->with('website',$request->input('website'))
                                         ->with('president_name',$request->input('president_name'))
                                         ->with('cell_phone',$request->input('cell_phone'))
                                         ->with('secretary_name',$request->input('secretary_name'))
                                         ->withErrors($validator);    
      }
      else{            
        $result = \App\Models\Businessinformation::registrar($request);
        if ($result->_error == 0 && $result->_msg == "ok"){ 
          $user = \App\Models\User::where('email',$request->input('email'))->first();
          Mail::to("ffueltala@gmail.com")->send(new \App\Mail\MarketUser($user));   
          return view('ownership.index');  
        }
        else{
          throw new \Exception("There was an error creating the user!");
        }       
      }
    }
    catch(\Exception $e){      
      $error = $e->getMessage(); 
      return view('information.create')->with('name',$request->input('name'))  
                                        ->with('token',$request->input('token'))     
                                        ->with('email',$request->input('email'))
                                        ->with('ruc_tax',$request->input('ruc_tax'))
                                        ->with('date_company',$request->input('date_company'))
                                        ->with('contact_name',$request->input('contact_name'))
                                        ->with('zip',$request->input('zip'))
                                        ->with('type_business',$request->input('type_bussiness'))
                                        ->with('country_id',$request->input('country_id'))
                                        ->with('state_id',$request->input('state_id'))
                                        ->with('address',$request->input('address'))
                                        ->with('city_id',$request->input('city_id'))
                                        ->with('dba',$request->input('dba'))
                                        ->with('phone',$request->input('phone'))
                                        ->with('website',$request->input('website'))
                                        ->with('president_name',$request->input('president_name'))
                                        ->with('cell_phone',$request->input('cell_phone'))
                                        ->with('secretary_name',$request->input('secretary_name'))
                                       ->withErrors($error);   
    }           
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id){

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id){
        //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
  */
  public function update(Request $request){
    $error = "";

    try{         
      $objuser = new \App\Models\User;
      $user = $objuser::find($request->input('user_id'));      
      $user->name = $request->input('name');
      $user->email = $request->input('email');        
      $user->updated_at = date("Y-m-d H:i:s");

      $objbusiness = new \App\Models\Businessinformation;
      $business = $objbusiness::find($request->input('business_id'));    
      $business->ruc_tax = $request->input('ruc_tax');
      $business->date_company = $request->input('date_company');
      $business->contact_name = $request->input('contact_name');
      $business->president_name = $request->input('president_name');
      $business->type_business = $request->input('type_business');
      $business->phone = $request->input('phone');
      $business->country_id = $request->input('country_id');
      $business->city_id = $request->input('city_id');
      $business->state_id = $request->input('state_id');
      $business->zip = $request->input('zip');
      $business->address = $request->input('address');
      $business->cell_phone = $request->input('cell_phone');
      $business->website = $request->input('website');
      $business->dba = $request->input('dba');
      $business->secretary_name = $request->input('secretary_name');

      $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'email' => 'required|unique:users,email,'.$request->input('user_id').'|email',
        'ruc_tax' => 'required|unique:businessinformations,ruc_tax,'.$request->input('business_id').'|max:255',
        'date_company' => 'required|date_format:Y-m-d',
        'contact_name' => 'required|max:255',
        'president_name' => 'required|max:255',
        'type_business' => 'required|max:255',
        'phone' => 'required|max:255',
        'country_id' => 'required|max:255',
        'city_id' => 'required|max:255',
        'state_id' => 'required|max:255',
        'zip' => 'required|max:255',
        'address' => 'required|max:255',
        'cell_phone' => 'nullable|max:255',
        'website' => 'nullable|max:255',
        'dba' => 'nullable|max:255',        
        'secretary_name' => 'nullable|max:255',
      ]);
      
      if ($validator->fails()) {        
        return view('information.edit')->with('user',$user)
                                       ->with('business',$business)      
                                       ->with('token',$request->input('token'))
                                       ->withErrors($validator);
      }
      else{      
        $result = \App\Models\Businessinformation::actualizar($request,$request->input('business_id'));
        if ($result->_error == 0 && $result->_msg == "ok"){                                          
          return view('ownership.index');  
        }        
        else{
          throw new \Exception("There was an error editing the user!");
        }       
      }
    }
    catch(\Exception $e){      
      $error = $e->getMessage();
      return view('information.edit')->with('user',$user)
                                     ->with('business',$business)                                     
                                     ->with('token',$request->input('token'))
                                     ->withErrors($error);      
    } 

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id){
        //
  }
}
