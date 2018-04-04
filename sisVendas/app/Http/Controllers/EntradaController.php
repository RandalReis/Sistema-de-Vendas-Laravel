<?php

namespace sisVendas\Http\Controllers;

use Illuminate\Http\Request;
use sisVendas\Http\Requests;
use sisVendas\Entrada;
use sisvendas\DetalheEntrada;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVendas\Http\Requests\EntradaFormRequest;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Colletion;


class EntradaController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $entradas=DB::table('entrada as en')
           ->join('pessoa as p','en.idprovedor','=','p.idpessoa')
           ->join('detalhe_entrada as de','en.identrada','=','de.identrada')         
           ->select('en.identrada','en.hora_fechamento','p.nome','en.tipo_comprovante','en.serie_comprovante','en.imposto','en.estado',DB::raw('sum(de.quantidade*preco_compra) as total'))
           ->where('en.num_comprovante','LIKE','%'.$query.'%')
           ->orderBy('en.identrada','desc')
           ->groupBy('en.identrada','en.hora_fechamento','p.nome','en.tipo_comprovante','en.serie_comprovante','en.imposto','en.estado')
           ->paginate(7);
           return view('compras.entrada.index',["entradas"=>$entradas,"searchText"=>$query]);       
        }  
    }  
    public function create()
    {
        $pessoas=DB::table('pessoa')->where('tipo_pessoa','=','Provedor')->get();
        $articulos = DB::table('articulo as art')
        ->select(DB::raw('CONCAT(art.codigo," ",art.nome) AS articulo'),'art.idarticulo')
        ->where('art.estado','=','Activo')
        ->get();
        return view("compras.entrada.create",["pessoas"=>$pessoas,"articulos"=>$articulos]);
    }  
       public function store (EntradaFormRequest $request)
       {
           try{
               DB::beginTransaction();
               $entrada=new Entrada;
               $entrada->idprovedor=$request->get('idprovedor');
               $entrada->tipo_comprovante=$request->get('tipo_comprovante');
               $entrada->serie_comprovante=$request->get('serie_comprovante');
               $entrada->num_comprovante=$request->get('num_comprovante');
               
               $mytime = Carbon::now('America/Sao_Paulo');
               $entrada->hora_fechamento=$mytime->toDateTimeString();
               $entrada->imposto='18';
               $entrada->estado='A';
               $entrada->save();

               $idarticulo = $request->get('idarticulo');
               $quantidade = $request->get('quantidade');
               $preco_compra = $request->get('preco_compra');
               $preco_venda  = $request->get('preco_venda');

               $cont = 0;

               while($cont < count($idarticulo)){
                $detalhe = new DetalheEntrada();
                $detalhe->identrada= $entrada->identrada;
                $detalhe->idarticulo= $idarticulo[$cont];
                $detalhe->quantidade= $quantidade[$cont];
                $detalhe->preco_compra= $preco_compra[$cont];
                $detalhe->preco_venda= $preco_venda[$cont];
                $detalhe->save();
                $cont=$cont+1;
               }

               DB::commit();
           }catch(\Exception $e)
           {
               DB::rollback();
           }

           return Redirect::to('compras/entrada');
       }
       public function show($id)
       {
           $entrada=DB::table('entrada as en')
           ->join('pessoa as p','en.idprovedor','=','p.idpessoa')
           ->join('detalhe_entrada as de','en.identrada','=','de.entrada')         
           ->select('en.identrada','en.hora_fechamento','p.nome','en.tipo_comprovante','en.serie_comprovante','en.imposto','en.estado',DB::raw('sum(de.quantidade*preco_compra) as total'))
           ->where('en.entrada','=',$id) 
           ->first();
           
           $detalhes=DB::table('detalhe_entrada as d')
           ->join('articulo as a','d.idarticulo','=','a.idarticulo')
           ->select('a.nome as articulo','d.quantidade','d.preco_compra','d.preco_venda')
           ->where('d.entrada','=',$id)
           ->get();
           return view("compras.entrada.show",["entrada"=>$entrada,"detalhes"=>$detalhes]);
        }
    public function destroy($id)
    {
        $entrada=Entrada::findOrFail($id);
        $entrada->Estado='C';
        $entrada->update();
        return Redirect::to('compras/entrada');
    }
}
