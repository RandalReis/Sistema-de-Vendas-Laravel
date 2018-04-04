@extends ('layouts.admin')
@section ('Conteudo')
  <div class="row">
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Novo Fornecedor</h3>
        @if (count($errors)>0)
        <div class="alert" alert-danger>
            <ul>
              @foreach ($errors->all() as $error)
               <li>{{$error}}</li>
              @endforeach 
            </ul>
        </div>
        @endif  
    </div>
  </div>
  {!!Form::open(array('url'=>'compras/provedor','method'=>'POST','autocomplete'=>'off')) !!}
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
             <option value="Rg">RG</option>
             <option value="Cpf">CPF</option>
             <option value="Cnh">CNH</option>
             </select>
          </div>
     </div>
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <div class="form-group">
           <label for="num_documento">Número de Documento</label>
           <input type="text" name="num_documento"  value="{{old('num_documento')}}" class="form-control" placeholder="Número de Documento...">
       </div>
     </div>
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <div class="form-group">
           <label for="telefone">Telefone</label>
           <input type="text" name="telefone" value="{{old('telefone')}}" class="form-control" placeholder="Telefone...">
       </div>
      </div> 
       <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <div class="form-group">
           <label for="email">Email</label>
           <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email...">
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