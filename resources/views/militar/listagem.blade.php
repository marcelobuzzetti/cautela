@extends('layout.principal')

@section('content')
<div class="row">
         <table class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Nome</th>
                  <th>Posto/Grad</th>
                  <th>Nome de Guerra</th>
                  <th>Telefone</th>
                  <th>E-mail</th>
                  <th>Pelotão</th>
                  <th>Atualizar</th>
                  @if(Auth::user()->perfil == 1)
                  <th>Apagar</th>
                  @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Nome</th>
                  <th>Posto/Grad</th>
                  <th>Nome de Guerra</th>
                  <th>Telefone</th>
                  <th>E-mail</th>
                  <th>Pelotão</th>
                  <th>Atualizar</th>
                  @if(Auth::user()->perfil == 1)
                  <th>Apagar</th>
                  @endif
              </tr>
            </tfoot>

            <tbody>
            @foreach ($militares as $m)
              <tr>
                <td>{{$m->nome}}</td>
                <td>{{$m->patente}}</td>
                <td>{{$m->nome_guerra}}</td>
                <td><a target="new_blank" href="https://api.whatsapp.com/send?phone=55{{$m->telefone}}&text=Cautela%20em%20Aberto"><img src="{{ asset('whatsapp.png') }}" height="42" width="42"></a>{{$m->telefone}}</td>
                <td><a href="mailto:{{$m->email}}" target="_top">{{$m->email}}</a></td>
                <td>{{$m->pelotao}}</td>
                <td><a class="btn btn-success" href="{{ action('MilitarController@altera', $m->id ) }}">Atualizar</a></td>
                @if(Auth::user()->perfil == 1)
                <form action="{{ action('MilitarController@apaga') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$m->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger" @if(Auth::user()->perfil != 1) disabled @endif>Apagar</button></td>
              </form>
              @endif
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection