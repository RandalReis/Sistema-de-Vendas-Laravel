@extends ('layouts.admin')
@section ('Conteudo')
  <div class="row">
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Cliente: {{ $pessoa->nome }}</h3>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
               <li>{{$error}}</li>
              @endforeach 
            </ul>
        </div>
        @endif 
     </div>    
  </div>
        {!!Form::model($pessoa,['method'=>'PATCH','route'=>['vendas.cliente.update',$pessoa->idpessoa]])!!}
        {{Form::token()}}
        <div class="row">
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
           <label for="nome">Nome</label>
           <input type="text" name="nome" required value="{{old('nome')}}" class="form-control" placeholder="Nome...">
        </div>
     </div>
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
           <label for="endereco">Endereço</label>
           <input type="text" name="endereco" required value="{{old('endereco')}}" class="form-control" placeholder="Endereço...">
        </div>
     </div>
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <div class="form-group">
             <label>Documento</label>
             <select name="tipo_documento" class="form-control">
             @if ($pessoa->tipo_documento=='Rg')
                  <option value="Rg" selected>RG</option>
                  <option value="Cpf">CPF</option>
                  <option value="Cnh">CNH</option>
             @elseif ($pessoa->tipo_documento=='Cpf')
                  <option value="Rg">RG</option>
                  <option value="Cpf" selected>CPF</option>
                  <option value="Cnh">CNH</option>
             @else 
                  <option value="Rg">RG</option>
                  <option value="Cpf">CPF</option>
                  <option value="Cnh"selected>CNH</option>
             @endif
             </select>
          </div>
     </div>
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <div class="form-group">
           <label for="num_documento">Número de Documento</label>
           <input type="text" name="num_documento"  value="{{$pessoa->num_documento}}" class="form-control" placeholder="Número de Documento...">
       </div>
     </div>
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <div class="form-group">
           <label for="telefone">Telefone</label>
           <input type="text" name="telefone" value="{{$pessoa->telefone}}" class="form-control" placeholder="Telefone...">
       </div>
      </div> 
       <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <div class="form-group">
           <label for="email">Email</label>
           <input type="email" name="email" value="{{$pessoa->email}}" class="form-control" placeholder="Email...">
       </div>
      </div> 
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           <div class="form-group">
              <button class="btn btn-primary" type="submit">Salvar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
           </div>
        </div>
  </div> 
        {!!Form::close()!!}
        
@endsection