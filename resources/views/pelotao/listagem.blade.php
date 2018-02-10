@extends('layout.principal')

@section('content')
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Pelotão</th>
                  <th>Atualizar</th>
                  @if(Auth::user()->perfil == 1)
                  <th>Apagar</th>
                  @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Pelotão</th>
                  <th>Atualizar</th>
                  @if(Auth::user()->perfil == 1)
                  <th>Apagar</th>
                  @endif
              </tr>
            </tfoot>

            <tbody>
            @foreach ($pelotoes as $p)
              <tr>
                <td>{{$p->nome}}</td>
                <td><a class="btn btn-success" href="{{ action('PelotaoController@altera', $p->id ) }}">Atualizar</a></td>
                @if(Auth::user()->perfil == 1)
                <form action="{{ action('PelotaoController@apaga') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$p->id}}"/>
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