<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class ClientsController extends Controller
{
    public function index()
    {
       
        $clients = DB::select("call get_clients_all()");
        var_dump($clients);
        //return View('clients/index')->with('clients'->$clients);
    }
    public function show($id)
    {
       
        $clients = DB::select("call Get_client_item(?)",[$id]);
        var_dump($clients);
        //return View('clients/index')->with('clients'->$clients);
    }
    public function create()
    {
        return view('clients.create');
    }
    public function edit($id)
    {
        $codigo = $id;
        $clients = DB::select("call Get_client_item(?)",[$id]);
        
        $_email = $clients[0]->email;
        $_active = $clients[0]->active;
        $_name = $clients[0]->name;
        $_checked = "";
        if($clients[0]->active == "1") {
            $_checked = "checked";
        }
        return View('clients.edit')
           ->with('codigo', $codigo)
           ->with('_email', $_email)
           ->with('_active', $_active)
           ->with('_name',$_name)
           ->with('_checked',$_checked);
    }
    public function store(Request $request)
    {
        $error="0";
        $msg= "";
        $result = DB::select('call Insert_client(?,?,?,?)',
                     [
                        $request->input('name'),
                        $request->input('email'),
                        $error,
                        $msg
                     ]);
        var_dump($result);
        
       
    }
    public function update(Request $request, $codigo)
    {
        $error="0";
        $msg= "";
        $active = 0;
        if(!empty($request->input('active'))){
            $active = 1;
        }
        
        $result = DB::select('call Update_client(?,?,?,?,?,?)',
                     [
                        $codigo,
                        $request->input('name'),
                        $request->input('email'),
                        $active,
                        $error,
                        $msg
                     ]);
        var_dump($result);
        
       
    }
}
