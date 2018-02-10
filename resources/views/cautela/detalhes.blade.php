@extends('layout.principal')

@section('content')
  <br>
  <div class="jumbotron">
    <h1 class="display-4"> @foreach ($cautela as $c)
    <p>Cautela nº {{$c->id}} - {{$c->patente}} {{$c->nome}}</p>
    @endforeach</h1>
  </div>

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
@endsection