<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = \App\Models\_client::todos();
        var_dump($clients);
    
    }
    public function show($id)
    {
        $client = \App\Models\_client::individual($id);
        var_dump($client);
    }
    public function create()
    {
        return view('clients.create');
    }
    public function edit($id)
    {
        $client = \App\Models\_client::individual($id);
             
        return View('clients.edit')
           ->with('client', $client);
       
    }
    public function store(Request $request)
    {
       
        $result = \App\Models\_client::registrar($request);
        var_dump($result);
        
       
    }
    public function update(Request $request, $codigo)
    {
       
        $result = \App\Models\_client::actualizar($request, $codigo);
        var_dump($result);
        
    }
}
