@extends('layout.principal')

@section('content')
<div class="row">
         <table class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Nome</th>
                  <th>Posto/Grad</th>
                  <th>Nome de Guerra</th>
                  <th>Pelotão</th>
                  <th>Atualizar</th>
                  <th>Apagar</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Nome</th>
                  <th>Posto/Grad</th>
                  <th>Nome de Guerra</th>
                  <th>Pelotão</th>
                  <th>Atualizar</th>
                  <th>Apagar</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($militares as $m)
              <tr>
                <td>{{$m->nome}}</td>
                <td>{{$m->patente}}</td>
                <td>{{$m->nome_guerra}}</td>
                <td>{{$m->pelotao}}</td>
                <td><a class="btn btn-success" href="{{ action('MilitarController@altera', $m->id ) }}">Atualizar</a></td>
                <form action="{{ action('MilitarController@apaga') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$m->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger" @if(Auth::user()->perfil != 1) disabled @endif>Apagar</button></td>
              </form>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection