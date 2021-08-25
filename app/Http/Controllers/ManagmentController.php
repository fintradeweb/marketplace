<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class ManagmentController extends Controller{

  public function create(){
    return view('ownership.create');
  }

  public function edit($id){
    $ownerships = \App\Models\Managment::consulta($id);
    return view('ownership.edit')->with('ownerships', $ownerships);
  }

  public function store(Request $request){

    $result = \App\Models\Managment::registrar($request);

  }

    public function update(Request $request, $codigo)
    {

        $result = \App\Models\Managment::actualizar($request, $codigo);
    }
}
