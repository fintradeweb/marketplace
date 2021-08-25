<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class CertificationController extends Controller{

  public function create(){
    return view('certification.create');
  }

  public function edit($id){
    $certification = \App\Models\Certification::consulta($id);
    return view('certification.edit')->with('certification', $certification);
  }

  public function store(Request $request){

    $result = \App\Models\Certification::registrar($request);

  }

    public function update(Request $request, $codigo)
    {

        $result = \App\Models\Certification::actualizar($request, $codigo);
    }
}
