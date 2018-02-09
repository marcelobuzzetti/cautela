@extends('layout.principal')

@section('content')
<div class="container">
  <div class="jumbotron">
    <h1 class="display-4"> @foreach ($cautela as $c)
    <p>Cautela nº {{$c->id}} - {{$c->patente}} {{$c->nome}}</p>
    @endforeach</h1>
  </div>
</div>

<div class="row">

<div class="form-group">
    <label>Cautela</label>
    @foreach ($cautela as $c)
    <input name="cautela" value="{{$c->id}}" hidden="hidden">
    <p>Número {{$c->id}} - Militar {{$c->nome}}</p>
    @endforeach
  </div>
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Situação</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Situação</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelados as $c)
              <tr>
                <td>{{$c->nome}}</td>
                <td>{{$c->data_cautela}}</td>
                <td>{{$c->quantidade}}</td>
                 @if($c->data_entrega == NULL)
                <form action="{{ action('CautelaMaterialController@entrega') }}" method="post">
                  <input name="cautela" value="{{$c->cautela}}" type="hidden">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger">Entregar</button></td>
                </form>
                @else
                <td>Entregue em {{$c->data_entrega}}</td>
                @endif
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection