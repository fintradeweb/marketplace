<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class BusinessinformationController extends Controller{

  public function create(){
    return view('businessinformation.create');
  }

  public function edit($id){
    $client = \App\Models\Client::individual($id);
    return view('clients.edit')->with('client', $client);
  }

  public function store(Request $request){
    $validatedData = $request->validate([
      'name' => 'required|unique:users|max:255',
      'email' => 'required|unique:users|email',
    ]);
    $result = \App\Models\User::registrar($request);
    /*if ($result->_error==1){
      throw new \Exception($result->_msg);
    }
    else{
      var_dump($result);
    }*/
  }

    public function update(Request $request, $codigo)
    {

        $result = \App\Models\Businessinformation::actualizar($request, $codigo);
        if ($result->_error==1){
            throw new \Exception($result->_msg);

        }
        else{
            var_dump($result);
        }

    }
}
