@extends('layout.principal')

@section('content')
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Nome</th>
                  <th>Valor</th>
                  <th>Descrição</th>
                  <th>Quantidade</th>
                  <th>Reserva</th>
                  <th>Atualizar</th>
                  <th>Apagar</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Nome</th>
                  <th>Valor</th>
                  <th>Descrição</th>
                  <th>Quantidade</th>
                  <th>Reserva</th>
                  <th>Atualizar</th>
                  <th>Apagar</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($materiais as $m)
              <tr>
                <td>{{$m->nome}}</td>
                <td>{{$m->valor}}</td>
                <td>{{$m->descricao or 'nenhuma descrição'}}</td>
                <td>{{$m->quantidade}}</td>
                <td>{{$m->reserva}}</td>
                <td><a class="btn btn-success" href="{{ action('MaterialController@altera', $m->id ) }}">Atualizar</a></td>
                <form action="{{ action('MaterialController@apaga') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$m->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger">Apagar</button></td>
              </form>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection