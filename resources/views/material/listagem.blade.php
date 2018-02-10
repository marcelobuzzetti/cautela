@extends('layout.principal')

@section('content')
<br>
  <div class="jumbotron">
    <h1 class="display-4">Lista de Materiais</h1>
  </div>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Nome</th>
                  <th>Valor</th>
                  <th>Descrição</th>
                  <th>Quantidade</th>
                  <th>Reserva</th>
                  @if(Auth::user()->perfil == 1)
                  <th>Atualizar</th>
                  <th>Apagar</th>
                  @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Nome</th>
                  <th>Valor</th>
                  <th>Descrição</th>
                  <th>Quantidade</th>
                  <th>Reserva</th>
                  @if(Auth::user()->perfil == 1)
                  <th>Atualizar</th>
                  <th>Apagar</th>
                  @endif
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
                 @if(Auth::user()->perfil == 1)
                <td><a class="btn btn-success" href="{{ action('MaterialController@altera', $m->id ) }}">Atualizar</a></td>
                <form action="{{ action('MaterialController@apaga') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$m->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger" >Apagar</button></td>
                @endif
              </form>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection