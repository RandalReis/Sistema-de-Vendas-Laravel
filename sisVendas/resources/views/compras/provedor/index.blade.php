@extends ('layouts.admin')
@section ('Conteudo')
  <div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Lista de Fornecedores<a href="provedor/create"><button class="btn btn-success">Novo</button></a></h3>
          @include('compras.provedor.search')
     </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
         <table class="table table-striped table-bordered table-condensed table-houver">
           <thead>
             <th>Id</th>
             <th>Nome</th>
             <th>Tipo documento</th>
             <th>Numero documento</th>
             <th>Telefone</th>
             <th>Email</th>
             <th>Opções</th>
           </thead>
           @foreach ($pessoas as $pes)
            <tr>
               <td>{{ $pes->idpessoa }}</td>
               <td>{{ $pes->nome }}</td>
               <td>{{ $pes->tipo_documento }}</td>
               <td>{{ $pes->num_documento }}</td>
               <td>{{ $pes->telefone }}</td>
               <td>{{ $pes->email }}</td>
               <td>
                <a href="{{URL::action('ProvedorController@edit',$pes->idpessoa)}}"><button class="btn btn-info">Editar</button></a>
                <a href="" data-target="#modal-delete-{{$pes->idpessoa}}" data-toggle="modal"><button class="btn btn-danger">Deletar</button></a>
               </td>
            </tr>
           
            @include('compras.provedor.modal')
           @endforeach
         </table>
        
      </div>
      {{ $pessoas->render() }}
    </div>
  </div>

@endsection