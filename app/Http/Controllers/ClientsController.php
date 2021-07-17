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

  public function show($id){
    $client = \App\Models\Client::individual($id);
    return view('clients.show', [
      'client' => $client
    ]);    
  }

  public function create(){
    return view('clients.create');
  }

  public function edit($id){
    $client = \App\Models\Client::individual($id);             
    return view('clients.edit')->with('client', $client);
       
  }

  public function store(Request $request){    
    $validatedData = $request->validate([
      'name' => 'required|unique:clients|max:255',
      'email' => 'required|unique:clients|email',
    ]);
    $result = \App\Models\Client::registrar($request);    
  }

  public function update(Request $request, $codigo){       
    $validatedData = $request->validate([
      'name' => 'required|unique:clients,name,'.$codigo.'|max:255',
      'email' => 'required|unique:clients,email,'.$codigo.'|email',
    ]);    
    $result = \App\Models\Client::actualizar($request, $codigo);    
  }
}
