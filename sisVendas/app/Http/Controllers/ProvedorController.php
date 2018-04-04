<?php

namespace sisVendas\Http\Controllers;

use Illuminate\Http\Request;
use sisVendas\Pessoa;
use Illuminate\Support\Facades\Redirect;
use sisVendas\Http\Requests\PessoaFormRequest;
use DB;


class ProvedorController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $pessoas=DB::table('pessoa')
           ->where('nome','LIKE','%'.$query.'%')
           ->where ('tipo_pessoa','=','Provedor')
           ->orwhere('num_documento','LIKE','%'.$query.'%')
           ->where ('tipo_pessoa','=','Provedor')
           ->orderBy('idpessoa','desc')
           ->paginate(7);
           return view("compras.provedor.index",["pessoas"=>$pessoas,"searchText"=>$query]);
           
       }
    }
    public function create()
    {
      return view("compras.provedor.create");
    }
    public function store(PessoaFormRequest $request)
    {
      $pessoa=new Pessoa;
      $pessoa->tipo_pessoa='Provedor';
      $pessoa->nome=$request->get('nome');
      $pessoa->tipo_documento=$request->get('tipo_documento');
      $pessoa->num_documento=$request->get('num_documento');
      $pessoa->endereco=$request->get('endereco');
      $pessoa->telefone=$request->get('telefone');
      $pessoa->email=$request->get('email');
      $pessoa->save();
      return Redirect::to('compras/provedor');

    }
    public function show($id)
    {
     return view("compras.provedor.show",["pessoa"=>Pessoa::findOrFail($id)]); 
    }
    public function edit($id)
    {
        return view("compras.provedor.edit",["pessoa"=>Pessoa::findOrFail($id)]);
    }
    public function update(PessoaFormRequest $request,$id)
    {
      $pessoa=Pessoa::findOrFail($id);
      $pessoa->nome=$request->get('nome');
      $pessoa->tipo_documento=$request->get('tipo_documento');
      $pessoa->num_documento=$request->get('num_documento');
      $pessoa->endereco=$request->get('endereco');
      $pessoa->telefone=$request->get('telefone');
      $pessoa->email=$request->get('email');
      $pessoa->update();
      return Redirect::to('compras/provedor'); 
    }
    public function destroy($id)
    {
     $pessoa=Pessoa::findOrFail($id);
     $pessoa->tipo_pessoa='Inactivo';
     $pessoa->update();
     return Redirect::to('compras/provedor');

    }
}
