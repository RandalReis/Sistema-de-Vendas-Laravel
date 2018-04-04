@extends ('layouts.admin')
@section ('Conteudo')
  <div class="row">
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Artigo: {{ $articulo->nome }}</h3>
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
        {!!Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}
        {{Form::token()}}
        
        <div class="row">
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
           <label for="nome">Nome</label>
           <input type="text" name="nome" required value="{{$articulo->nome}}" class="form-control">
        </div>
     </div>
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <div class="form-group">
             <label>Categoria</label>
             <select name="idcategoria" class="form-control">
                @foreach ($categorias as $cat)
                     @if ($cat->idcategoria==$articulo->idcategoria)  
                     <option value="{{$cat->idcategoria}}" selected>{{$cat->nome}}</option>    
                     @else
                     <option value="{{$cat->idcategoria}}">{{$cat->nome}}</option>
                     @endif
                @endforeach     
             </select>
          </div>
     </div>
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <div class="form-group">
           <label for="codigo">Código</label>
           <input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control">
       </div>
     </div>
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <div class="form-group">
           <label for="estoque">Estoque</label>
           <input type="text" name="estoque" required value="{{$articulo->estoque}}" class="form-control">
       </div>
      </div> 
     <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <div class="form-group">
           <label for="descricao">Descrição</label>
           <input type="text" name="descricao" value="{{$articulo->descricao}}" class="form-control" placeholder="Descriçao...">
        </div>
      </div>  

      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
           <label for="imagem">Imagem</label>
           <input type="file" name="imagem" class="form-control">
           @if (($articulo->imagem)!="")
              <img src="{{asset('imagens/articulos/'.$articulo->imagem)}}" height="300px" width="300px">
           @endif   
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