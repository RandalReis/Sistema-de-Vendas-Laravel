@extends ('layouts.admin')
@section ('Conteudo')
  <div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Lista de Entradas<a href="entrada/create"><button class="btn btn-success">Novo</button></a></h3>
          @include('compras.entrada.search')
     </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
         <table class="table table-striped table-bordered table-condensed table-houver">
           <thead>
            
             <th>Fechamento</th>
             <th>Fornecedor</th>
             <th>Comprovante</th>
             <th>Numero do comprovante</th>
             <th>Imposto</th>
             <th>Total</th>
             <th>Estado</th>
             <th>Opções</th>
           </thead>
           @foreach ($entradas as $ent)
            <tr>
               
               <td>{{ $ent->hora_fechamento }}</td>
               <td>{{ $ent->nome }}</td>
               <td>{{ $ent->tipo_comprovante}}</td>
               <td>{{ $ent->serie_comprovante}}</td>
               
               <td>{{ $ent->imposto }}</td>
               <td>{{ $ent->total }}</td>
               <td>{{ $ent->estado }}</td>
               <td>
                <a href="{{URL::action('EntradaController@show',$ent->identrada)}}"><button class="btn btn-primary">Detalhe</button></a>
                <a href="" data-target="#modal-delete-{{$ent->identrada}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
               </td>
            </tr>
           
            @include('compras.entrada.modal')
           @endforeach
         </table>
        
      </div>
      {{ $entradas->render() }}
    </div>
  </div>

@endsection