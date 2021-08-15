<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InformationController extends Controller{
      
  public function index(Request $request){
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
        return view('information.edit')->with('user', $user)
                                       ->with('token',$request->input('token'));
      }
      else{           
        return view('information.create')->with('nombre',$request->input('nombre'))
                                         ->with('token',$request->input('token'))
                                         ->with('txt_email',$request->input('txt_email'))
                                         ->with('txt_taxid',$request->input('txt_taxid'))
                                         ->with('txt_datecompany',$request->input('txt_datecompany'))
                                         ->with('txt_contactname',$request->input('txt_contactname'))
                                         ->with('txt_zipcode',$request->input('txt_zipcode'))
                                         ->with('txt_typeofbusiness',$request->input('txt_typebusiness'))
                                         ->with('txt_country',$request->input('txt_country'))
                                         ->with('txt_state',$request->input('txt_state'))
                                         ->with('txt_address',$request->input('txt_address'))
                                         ->with('txt_city',$request->input('txt_city'))                                                 
                                         ->with('txt_dba',$request->input('txt_dba'))
                                         ->with('txt_phone',$request->input('txt_phone'))
                                         ->with('txt_website',$request->input('txt_website'))
                                         ->with('txt_presidentname',$request->input('txt_president'))
                                         ->with('txt_cellphone',$request->input('txt_cellphone'))
                                         ->with('txt_secretaryname',$request->input('txt_secretary'));
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
        'name' => 'required|alpha|max:255',
        'email' => 'required|unique:users|email',
        'taxid' => 'required|unique:users|max:255',
        'datecompany' => 'required|date_format:Y-m-d',
        'contactname' => 'required|alpha',
        'presidentname' => 'required|alpha',
        'typeofbusiness' => 'required|alpha',
        'phone' => 'required|alpha_num',
        'country' => 'required|alpha',
        'city' => 'required|alpha',
        'state' => 'required|alpha',
        'zipcode' => 'required|alpha_num',
        'address' => 'required|alpha_num',
        'cellphone' => 'nullable|alpha_num',
        'website' => 'nullable|alpha_dash',
        'dba' => 'nullable|alpha_num',
        'website' => 'nullable|alpha_dash',
        'secretaryname' => 'nullable|alpha',
      ]);
      if ($validator->fails()) {
        return view('information.create')->with('nombre',$request->input('name'))  
                                         ->with('token',$request->input('token'))                                   
                                         ->with('txt_email',$request->input('email'))
                                         ->with('txt_taxid',$request->input('taxid'))
                                         ->with('txt_datecompany',$request->input('datecompany'))
                                         ->with('txt_contactname',$request->input('contactname'))
                                         ->with('txt_zipcode',$request->input('zipcode'))
                                         ->with('txt_typeofbusiness',$request->input('typeofbusiness'))
                                         ->with('txt_country',$request->input('country'))
                                         ->with('txt_state',$request->input('state'))
                                         ->with('txt_address',$request->input('address'))
                                         ->with('txt_city',$request->input('city'))                                                 
                                         ->with('txt_dba',$request->input('dba'))
                                         ->with('txt_phone',$request->input('phone'))
                                         ->with('txt_website',$request->input('website'))
                                         ->with('txt_presidentname',$request->input('presidentname'))
                                         ->with('txt_cellphone',$request->input('cellphone'))
                                         ->with('txt_secretaryname',$request->input('secretaryname'))
                                         ->withErrors($validator);    
      }
      else{
        $password = bcrypt(Str::random(10));
        $user = new \App\Models\User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $password;
        $user->created_at = date("Y-m-d H:i:s");
        $user->taxid = $request->input('taxid');
        $user->datecompany = $request->input('datecompany');
        $user->contactname = $request->input('contactname');
        $user->presidentname = $request->input('presidentname');
        $user->typeofbusiness = $request->input('typeofbusiness');
        $user->phone = $request->input('phone');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->zipcode = $request->input('zipcode');
        $user->address = $request->input('address');
        $user->cellphone = $request->input('cellphone');
        $user->website = $request->input('website');
        $user->dba = $request->input('dba');
        $user->secretaryname = $request->input('secretaryname');
        $user->status = 1;
        if($user->save()){          
          Mail::to("ffueltala@gmail.com")->send(new \App\Mail\MarketReceived($user));
          return view('ownership.index');
          //pantalla de ownership
        }
        else{
          return view('information.create')->with('nombre',$request->input('name'))  
                                           ->with('token',$request->input('token'))                                   
                                           ->with('txt_email',$request->input('email'))
                                           ->with('txt_taxid',$request->input('taxid'))
                                           ->with('txt_datecompany',$request->input('datecompany'))
                                           ->with('txt_contactname',$request->input('contactname'))
                                           ->with('txt_zipcode',$request->input('zipcode'))
                                           ->with('txt_typeofbusiness',$request->input('typeofbusiness'))
                                           ->with('txt_country',$request->input('country'))
                                           ->with('txt_state',$request->input('state'))
                                           ->with('txt_address',$request->input('address'))
                                           ->with('txt_city',$request->input('city'))                                                 
                                           ->with('txt_dba',$request->input('dba'))
                                           ->with('txt_phone',$request->input('phone'))
                                           ->with('txt_website',$request->input('website'))
                                           ->with('txt_presidentname',$request->input('presidentname'))
                                           ->with('txt_cellphone',$request->input('cellphone'))
                                           ->with('txt_secretaryname',$request->input('secretaryname'))
                                           ->withErrors('There was an error creating the user!'); 
        }       
      }
    }
    catch(\Exception $e){
      $error = $e->getMessage();      
    }           
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id){
        //
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
      $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'email' => 'required|unique:users,email,'.$request->input('id').'|email',
        'taxid' => 'required|unique:users,taxid,'.$request->input('id').'|max:255',
        'datecompany' => 'required|date_format:Y-m-d',
        'contactname' => 'required|max:255',
        'presidentname' => 'required|max:255',
        'typeofbusiness' => 'required|max:255',
        'phone' => 'required|max:255',
        'country' => 'required|max:255',
        'city' => 'required|max:255',
        'state' => 'required|max:255',
        'zipcode' => 'required|max:255',
        'address' => 'required|max:255',
        'cellphone' => 'nullable|max:255',
        'website' => 'nullable|max:255',
        'dba' => 'nullable|max:255',
        'website' => 'nullable|max:255',
        'secretaryname' => 'nullable|max:255',
      ]);
      $objuser = new \App\Models\User;
      $user = $objuser::find($request->input('id'));      
      $user->name = $request->input('name');
      $user->email = $request->input('email');        
      $user->updated_at = date("Y-m-d H:i:s");
      $user->taxid = $request->input('taxid');
      $user->datecompany = $request->input('datecompany');
      $user->contactname = $request->input('contactname');
      $user->presidentname = $request->input('presidentname');
      $user->typeofbusiness = $request->input('typeofbusiness');
      $user->phone = $request->input('phone');
      $user->country = $request->input('country');
      $user->city = $request->input('city');
      $user->state = $request->input('state');
      $user->zipcode = $request->input('zipcode');
      $user->address = $request->input('address');
      $user->cellphone = $request->input('cellphone');
      $user->website = $request->input('website');
      $user->dba = $request->input('dba');
      $user->secretaryname = $request->input('secretaryname');
      if ($validator->fails()) {        
        return view('information.edit')->with('user',$user)
                                       ->with('token',$request->input('token'))
                                       ->withErrors($validator);
      }
      else{           
        if($user->save()){                              
          return view('ownership.index');
        }
        else{
          return view('information.edit')->with('user',$user)
                                         ->with('token',$request->input('token'))
                                         ->withErrors('There was an error editing the user!');
        }       
      }
    }
    catch(\Exception $e){
      $error = $e->getMessage();      
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
