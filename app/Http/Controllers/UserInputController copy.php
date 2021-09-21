<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;

class UserInputController extends Controller{




  public function store(Request $request){
    $validator = Validator::make($request->all(), [
        'email' => 'required',
        'name' => 'required',
        'rol_id' => 'required'
      ]);


      if ($validator->fails()) {

        return view('financial.create',[
            'email' =>$request->input('email'),
            'name' =>$request->input('name'),
            'rol_id' =>$request->input('rol_id'),

        ])->withErrors($validator);
      }

    $result = \App\Models\User::create_user_admin_super($request);
    if ($result[0]->_error == 0 && $result[0]->_msg == "ok"){
        $user = \App\Models\User::where('email',$request->input('email'))->first();
        $user->password = $result[1];
        Mail::to("ffueltala@gmail.com")->send(new \App\Mail\MarketUser($user));
        return view('bankinformation.edit',[
            'email' =>$request->input('email'),
            'token' =>  $request->input('token'),
            'indiv' =>  $indiv[1][0]
        ]);

    }
    else{
        return view('financial.create',[
            'email' =>$request->input('email'),
            'name' =>$request->input('name'),
            'rol_id' =>$request->input('rol_id'),
        ])->withErrors('There was an error creating user');
    }


  }

  public function update(Request $request, $codigo)
  {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'rol_id' => 'required'
        ]);
        $status = "";


        if(!empty($request->input('status'))){
            $status = " checked";
        }

        if ($validator->fails()) {

            return view('financial.create',[
                'email' =>$request->input('email'),
                'name' =>  $request->input('name'),
                'status'=>$status,
                "rol_id"=> $request->input('rol_id')

            ])->withErrors($validator);
        }
        $result = \App\Models\User::update_user_admin_super($request, $codigo);
        if ($result[0]->_error == 0 && $result[0]->_msg == "ok"){
            $user = \App\Models\User::where('email',$request->input('email'))->first();
            $user->password = $result[1];
            Mail::to("ffueltala@gmail.com")->send(new \App\Mail\MarketUser($user));
            return view('bankinformation.edit',[
                'email' =>$request->input('email'),
                'name' =>  $request->input('name'),
                'status'=>$status,
                "rol_id"=> $request->input('rol_id')
            ]);

        }
        else{
            return view('financial.create',[
                'email' =>$request->input('email'),
                'name' =>  $request->input('name'),
                'status'=>$status,
                "rol_id"=> $request->input('rol_id')
            ])->withErrors('There was an error creating user');
        }


  }


}
