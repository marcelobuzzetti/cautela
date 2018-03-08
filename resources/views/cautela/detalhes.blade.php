@extends('layout.principal')

@section('content')
  <br>
  <b><p class="text-center"><img src="{{ asset('brasao.png') }}" height="100" width="100"><br>MINISTÉRIO DA DEFESA<br>EXÉRCITO BRASILEIRO<br>2ª COMPANHIA DE COMUNICAÇÕES LEVE<br>(Cia Trns/1ºB. Trns/1935)</p></b>
  @foreach ($cautela as $c)
<div class="row">
    <div class="col-12 col-sm-12 col-md-4">
      Cautela nº {{$c->id}} - {{$c->patente}} {{$c->nome}}
    </div>
    <div class="col-12 col-sm-12 col-md-4">
      Telefone <a target="-top" href="https://api.whatsapp.com/send?phone=55{{$c->telefone}}&text=Cautela%20em%20Aberto">{{$c->telefone}}</a>
    </div>
    <div class="col-12 col-sm-12 col-md-4">
       E-mail  <a href="mailto:{{$c->email}}?Subject=Cautela%20aberta" target="_top">{{$c->email}}</a>
    </div>
  </div>
    <p>Material cautelado na(o) {{ $c->reserva }}</p>
    @endforeach</h1>
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
      <div class="row">
        <div class="col">
        @foreach ($cautela as $c)
        <p class="text-center">{{ $c->nome_completo }} - {{ $c->patente}} <br> {{ $c->pelotao }}</p>
        @endforeach
      </div>
      <div class="col">
        <p class="text-center">Encarregado da Reserva</p>
      </div>
    </div>

@endsection