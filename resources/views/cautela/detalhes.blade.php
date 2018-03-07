@extends('layout.principal')

@section('content')
  <br>
  <div class="jumbotron">
    <h1 class="display-4"> @foreach ($cautela as $c)
    <p>Cautela nº {{$c->id}} - {{$c->patente}} {{$c->nome}}</p>
    <p>Telefone <a target="-top" href="https://api.whatsapp.com/send?phone=55{{$c->telefone}}&text=Cautela%20em%20Aberto">{{$c->telefone}}</a></p>
    <p> E-mail  <a href="mailto:{{$c->email}}?Subject=Cautela%20aberta" target="_top">{{$c->email}}</p></a></p>
</p>
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
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Observação</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelados as $c)
              <tr>
                <td>{{$c->nome}}</td>
                <td>{{$c->data_cautela}}</td>
                <td>{{$c->quantidade}}</td>
                <td>{{$c->observacao_cautela or "Nenhuma Observação"}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
      <br>
      <br>
      <br>
      <br>
        @foreach ($cautela as $c)
        <p class="text-center">{{ $c->nome_completo }} - {{ $c->patente}} <br> {{ $c->pelotao }}</p>
        @endforeach
@endsection