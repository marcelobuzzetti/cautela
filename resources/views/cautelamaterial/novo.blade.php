@extends('layout.principal')

@section('content')
<blockquote class="blockquote text-center">
  <p class="mb-0">Cautela de Material</p>
</blockquote>
<form action="{{ action('CautelaMaterialController@adiciona') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <div class="form-group">
    @foreach ($cautela as $c)
    <input name="cautela" value="{{$c->id}}" type="hidden">
    <p>Cautela nº {{$c->id}} - Militar {{$c->nome}}</p>
    @endforeach
  </div>
  <div class="form-group">
    <label>Material</label>
    <select class="custom-select" id="material" name="material" required="required">
      <option value="" selected disabled>Selecione o Material</option>
      @foreach ($materiais as $m)
        <option value="{{$m->id}}">{{$m->nome}}</option>
      @endforeach
    </select>
  </div>
   <div class="form-group">
    <label>Quantidade</label>
    <input  class="form-control" type="number"  min="1" id="quantidade" name="quantidade" placeholder="Digite a quantidade">
  </div>
  <div class="form-group">
    <label>Observação</label>
    <input  class="form-control" type="text"  id="observacao_cautela" name="observacao_cautela" placeholder="Digite as alterações encontradas">
  </div>
  <div class="form-group">
    <label>Data Cautela</label>
    <input  class="form-control" type="date" name="data_cautela">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<blockquote class="blockquote text-center">
  <p class="mb-0">Relação de Materiais Cautelados</p>
</blockquote>
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Observação</th>
                  <th>Alteração</th>
                  <th>Entregar</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Observação</th>
                  <th>Alteração</th>
                  <th>Entregar</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelados as $c)
              <tr>
                <td>{{$c->nome}}</td>
                <td>{{$c->data_cautela}}</td>
                <td>{{$c->quantidade}}</td>
                <td>{{$c->observacao_cautela or "Nenhuma Observação"}}</td>
                @if($c->data_entrega == NULL)
                <form action="{{ action('CautelaMaterialController@entrega') }}" method="post">
                  <input name="cautela" value="{{$c->cautela}}" type="hidden">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                  <td><input class="form-control" type="text"  id="observacao_entrega" name="observacao_entrega" placeholder="Digite as alterações encontradas"></td>
                <td><button type="submit" class="btn btn-danger">Entregar</button></td>
                @else
                <td>{{$c->observacao_entrega  or "Nenhuma Alteração"}}</td>
                <td>Entregue em {{$c->data_entrega}}</td>
                @endif
                </form>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
     <!-- <div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Entregue em</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Entregue em</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($entregues as $e)
              <tr>
                <td>{{$e->nome}}</td>
                <td>{{$e->data_cautela}}</td>
                <td>{{$e->quantidade}}</td>
                <td>{{$e->data_entrega}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>-->
      </body>
@endsection