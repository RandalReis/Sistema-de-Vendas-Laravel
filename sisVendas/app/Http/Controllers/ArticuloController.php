<?php

namespace sisVendas\Http\Controllers;

use Illuminate\Http\Request;

use sisVendas\Http\Requests;
use sisVendas\Articulo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVendas\Http\Requests\ArticuloFormRequest;
use DB;

class ArticuloController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $articulos=DB::table('articulo as a')
           ->join('categoria as c','a.idcategoria','=','c.idcategoria')
           ->select('a.idarticulo','a.nome','a.codigo','a.estoque','c.nome as categoria','a.descricao','a.imagem','a.estado')

           ->where ('a.nome','LIKE','%'.$query.'%')
           ->orwhere ('a.codigo','LIKE','%'.$query.'%')
           ->orderBy('a.idarticulo','desc')
           ->paginate(7);
           return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
           
       }
    }
    public function create()
    {
      $categorias=DB::table('categoria')->where('cond','=','1')->get();  
      return view("almacen.articulo.create",["categorias"=>$categorias]);
    }
    public function store(ArticuloFormRequest $request)
    {
      $articulo=new Articulo;
      $articulo->idcategoria=$request->get('idcategoria');
      $articulo->codigo=$request->get('codigo');
      $articulo->nome=$request->get('nome');
      $articulo->estoque=$request->get('estoque');
      $articulo->descricao=$request->get('descricao');
      $articulo->estado='Activo';

      if (Input::hasFile('imagem')){
          $file=Input::file('imagem');
          $file->move(public_path().'/imagens/articulos/',$file->getClientOriginalName());
          $articulo->imagem=$file->getClientOriginalName();
      }
      $articulo->save();
      return Redirect::to('almacen/articulo');

    }
    public function show($id)
    {
     return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]); 
    }
    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('cond','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }
    public function update(ArticuloFormRequest $request,$id)
    {
      $articulo=Articulo::findOrFail($id);
      $articulo->idcategoria=$request->get('idcategoria');
      $articulo->codigo=$request->get('codigo');
      $articulo->nome=$request->get('nome');
      $articulo->estoque=$request->get('estoque');
      $articulo->descricao=$request->get('descricao');
      $articulo->estado='Activo';

      if (Input::hasFile('imagem')){
          $file=Input::file('imagem');
          $file->move(public_path().'/imagens/articulos/',$file->getClientOriginalName());
      }
      $articulo->update();
      return Redirect::to('almacen/articulo'); 
    }
    public function destroy($id)
    {
     $articulo=Articulo::findOrFail($id);
     $articulo->estado='Inactivo';
     $articulo->update();
     return Redirect::to('almacen/articulo');

    }
}
