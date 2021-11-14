<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller{
    
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $companies = \App\Models\Company::consulta_todos();
    return view('companies.index', [
      'companies' => $companies
    ]);
  }

  public function create(){
    return view('companies.create');
  }

  public function store(Request $request){
    $validatedData = $request->validate([
      'name' => 'required|unique:company|max:255',
      'description' => 'required|max:255',
      'address' => 'required|max:255',
    ]);
    $result = \App\Models\Company::registrar($request);   
    if ($result->_error == 0 && $result->_msg == "ok"){
       return redirect('/companies')->with('status', 'The company was created succesfully!');
    }else{
      return redirect('/companies/create')->withErrors($result->_msg);  
    }
  }

  public function show($id){
    $company = \App\Models\Company::consulta($id);
    return view('companies.show', [
      'company' => $company
    ]);  
  }

  public function edit($id){
    $company = \App\Models\Company::consulta($id);            
    return view('companies.edit')->with('company', $company);
  }

  public function update(Request $request, $id){
    $validatedData = $request->validate([
      'name' => 'required|unique:company,name,'.$id.'|max:255',
      'description' => 'required|max:255',
      'address' => 'required|max:255',
    ]);    
    $result = \App\Models\Company::actualizar($request, $id); 
    if ($result->_error == 0 && $result->_msg == "ok"){
      return redirect('/companies')->with('status', 'The company was edited succesfully!');
    }
    else{
      return redirect('/companies/'.$codigo.'/edit')->withErrors($result->_msg);          
    }  
  }

  public function destroy($id){
        //
  }
}
