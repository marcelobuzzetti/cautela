@extends('layout.principal')

@section('content')
<br>
  <div class="jumbotron">
    <h1 class="display-4">Lista de Reservas</h1>
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
                  @if(Auth::user()->perfil == 1)
                  <th>Atualizar</th>
                  <th>Apagar</th>
                  @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Nome</th>
                  @if(Auth::user()->perfil == 1)
                  <th>Atualizar</th>
                  <th>Apagar</th>
                  @endif
              </tr>
            </tfoot>

            <tbody>
            @foreach ($reservas as $r)
              <tr>
                <td>{{$r->nome}}</td>
                @if(Auth::user()->perfil == 1)
                <td><a class="btn btn-success" href="{{ action('ReservaController@altera', $r->id ) }}">Atualizar</a></td>
                <form action="{{ action('ReservaController@apaga') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$r->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger" >Apagar</button></td>
                </form>
                @endif
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection