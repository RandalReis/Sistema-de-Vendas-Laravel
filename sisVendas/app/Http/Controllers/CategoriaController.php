<?php
namespace sisVendas\Http\Controllers;
use Illuminate\Http\Request;
use sisVendas\Http\Requests;
use sisVendas\Categoria;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use sisVendas\Http\Requests\CategoriaFormRequest;
use DB;
class CategoriaController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $categorias=DB::table('categoria')->where('nome','LIKE','%'.$query.'%')
            ->where ('cond','=','1')
            ->orderBy('idcategoria','desc')
            ->paginate(7);
            return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("almacen.categoria.create");
    }
    public function store (CategoriaFormRequest $request)
    {
        $categoria=new Categoria;
        $categoria->nome=$request->get('nome');
        $categoria->descricao=$request->get('descricao');
        $categoria->cond='1';
        $categoria->save();
        return Redirect::to('almacen/categoria');
    }
    public function show($id)
    {
        return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(CategoriaFormRequest $request,$id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nome=$request->get('nome');
        $categoria->descricao=$request->get('descricao');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->cond='0';
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
}