@extends ('layouts.admin')
@section ('Conteudo')
  <div class="row">
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nova Entrada</h3>
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
  
  {!!Form::open(array('url'=>'compras/entrada','method'=>'POST','autocomplete'=>'off')) !!}
        {{Form::token()}}
<div class="row"> 
     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
           <label for="provedor">Fornecedor</label>
          <select name="idprovedor" id="idprovedor" class="form-control selectpicker" data-live-search="true" >
               @foreach($pessoas as $pessoa)
               <option value="{{$pessoa->idpessoa}}">{{$pessoa->nome}}</option> 
               @endforeach        
          </select>
        </div>
     </div>
  
  
     <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
          <div class="form-group">
             <label>Tipo de comprovante</label>
             <select name="tipo_comprovante" class="form-control">
             <option value="Boleto">Boleto</option>
             <option value="Fatura">Fatura</option>
             <option value="Ticket">Ticket</option>
             </select>
          </div>
     </div>       
  
  
     <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
       <div class="form-group">
           <label for="serie_comprovante">Serie do Comprovante</label>
           <input type="text" name="serie_comprovante"  value="{{old('serie_comprovante')}}" class="form-control" placeholder="Série do comprovante...">
       </div>
     </div>     
  
  
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
       <div class="form-group">
           <label for="num_comprovante">Numero do Comprovante</label>
           <input type="text" name="num_comprovante" required value="{{old('num_comprovante')}}" class="form-control" placeholder="Número do comprovante...">
       </div>
    </div>     
</div>

<div class="row">
      <div class="panel panel-primary" >
         <div class="panel-body">

            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
               <div class="form-group">
                  <label>Artigo</label>
                  <select name="pidarticulo" class="form-control selectpicker" data-live-search="true" id="pidarticulo">
                    @foreach($articulos as $articulo)
                    <option value="{{$articulo->idarticulo}}">{{$articulo->articulo}}</option>
                    @endforeach
                  </select>
               </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                   <label for="quantidade">Quantidade</label>
                   <input type="number" name="pquantidade" id="pquantidade" class="form-control" placeholder="Quantidade" >
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                  <label for="preco_compra">Preço de Compra</label>
                  <input type="number" name="ppreco_compra" id="ppreco_compra" class="form-control" placeholder="Compra" >
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                  <label for="preco_venda">Preço de Venda</label>
                  <input type="number" name="ppreco_venda" id="ppreco_venda" class="form-control" placeholder="Venda" >          
                </div>
            </div>

            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                <div class="form-group">
                 <button type="button" id="bt_add" class="btn btn-primary" >agregar</button>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                 <table class"table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color:#A9D0F5">
                       <th>Opções</th>
                       <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                       <th>Artigo</th>
                       <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                       <th>Quantidade</th>
                       <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                       <th>Preço de Compra</th>
                       <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                       <th>Preço de Venda</th>
                       <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                       <th>Subtotal</th>
                    </thead>
                    <tfoot>
                       <th>Total</th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th></th>
                       <th><h4 id="total">S/. 0.00</h4></th>
                    </tfoot>
                    <tbody>

                    </tbody>
                 </table>    
            </div>
          </div>  
      
</div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
           <div class="form-group">
              <input name="_token" value="{{ csrf_token() }}" type="hidden" ></input>
              <button class="btn btn-primary" type="submit">Salvar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
           </div>
        </div>
      </div>
   
            
        {!!Form::close()!!}
  @push ('scripts')
  <script>
   $(document).ready(function(){
     $('#bt_add').click(function(){
       agregar();
     });
   });

  var cont=0;
  total=0;
  subtotal=[];
  $("#guardar").hide();

  function agregar()
  {
    idarticulo=$("#pidarticulo").val();
    articulo=$("#pidarticulo option:selected").text();
    quantidade=$("#pquantidade").val();
    preco_compra=$("#ppreco_compra").val();
    preco_venda=$("#ppreco_venda").val();

    if (idarticulo!="" && quantidade!="" && quantidade>0 && preco_compra!="" && preco_venda!="")
     {
       subtotal[cont]=(quantidade*preco_compra);
       total=total+subtotal[cont];

       var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="quantidade[]" value="'+quantidade+'"></td><td><input type="number" name="preco_compra[]" value="'+preco_compra+'"></td><td><input type="number" name="preco_venda[]" value="'+preco_venda+'"></td><td>'+subtotal[cont]+'</td></tr>';
     cont++;
     limpar();
     $("#total").html("S/. " + total);
     validar();
     $('#detalhes').append(fila);
     }
     else
     {
       alert("Erro ao ingressar os detalhes da entrada, revise os dados do artigo!");
     }
      }

     function limpar()
     {
       $("#pquantidade").val("");
       $("#ppreco_compra").val("");
       $("#ppreco_venda").val("");
     }
     function validar()
     {
       if (total>0)
       {
         $("#guardar").show();
       }
       else
       {
         $("#guardar").hide();
       }
     }
     function eliminar(index)
     {
       total=total-subtotal[index];
       $("#total").html("S/. " + total);
       $("#fila" + index).remove();
       validar();
     }
  </script>
  @endpush      
@endsection