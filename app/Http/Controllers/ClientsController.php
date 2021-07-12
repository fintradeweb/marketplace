<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ClientsController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $clients = \App\Models\Client::todos();
    return view('clients.index', [
        'clients' => $clients
    ]);
  }

    public function show($id)
    {
        $client = \App\Models\Client::individual($id);
        var_dump($client);
    }

  public function create(){
    return view('clients.create');
  }

    public function edit($id)
    {
        $client = \App\Models\Client::individual($id);
             
        return View('clients.edit')
           ->with('client', $client);
       
    }

  public function store(Request $request){
    var_dump($request);
    //$result = \App\Models\Client::registrar($request);
    //var_dump($result);     
  }

    public function update(Request $request, $codigo)
    {
       
        $result = \App\Models\Client::actualizar($request, $codigo);
        var_dump($result);
        
    }
}
