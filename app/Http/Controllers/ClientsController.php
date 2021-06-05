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
    
}
