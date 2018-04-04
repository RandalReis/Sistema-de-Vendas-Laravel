@extends ('layouts.admin')
@section ('Conteudo')
  <div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Lista de Artigos<a href="articulo/create"><button class="btn btn-success">Novo</button></a></h3>
          @include('almacen.articulo.search')
     </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
         <table class="table table-striped table-bordered table-condensed table-houver">
           <thead>
             <th>Id</th>
             <th>Nome</th>
             <th>Código</th>
             <th>Categorias</th>
             <th>Estoque</th>
             <th>Imagem</th>
             <th>Estado</th>
             <th>Opções</th>
           </thead>
           @foreach ($articulos as $art)
            <tr>
               <td>{{ $art->idarticulo }}</td>
               <td>{{ $art->nome }}</td>
               <td>{{ $art->codigo }}</td>
               <td>{{ $art->categoria }}</td>
               <td>{{ $art->estoque }}</td>
               <td>
               <img src="{{asset('imagens/articulos/'.$art->imagem)}}" alt="{{$art->nome}}" height="100px" width="100px" class="img-thumbnail">
               </td>
               <td>{{ $art->estado }}</td>
               <td>
                <a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info">Editar</button></a>
                <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Deletar</button></a>
               </td>
            </tr>
           
            @include('almacen.articulo.modal')
           @endforeach
         </table>
        
      </div>
      {{ $articulos->render() }}
    </div>
  </div>

@endsection