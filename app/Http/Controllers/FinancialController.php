<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class FinancialController extends Controller{

  public function create(){
    return view('financial.create');
  }

  public function edit($id){
    $financial = \App\Models\Financial::consulta($id);
    return view('financial.edit')->with('financial', $financial);
  }

  public function store(Request $request){

    $result = \App\Models\Financial::registrar($request);

  }

    public function update(Request $request, $codigo)
    {

        $result = \App\Models\Financial::actualizar($request, $codigo);
    }
}
