<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class BankinformationController extends Controller{

  public function create(){
    return view('bankinformation.create');
  }

  public function edit($id){
    $bankinformation = \App\Models\Bankinformation::consulta($id);
    return view('bankinformation.edit')->with('bankinformation', $bankinformation);
  }

  public function store(Request $request){

    $result = \App\Models\Bankinformation::registrar($request);

  }

    public function update(Request $request, $codigo)
    {

        $result = \App\Models\Bankinformation::actualizar($request, $codigo);
    }
}
