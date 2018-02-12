@extends('layout.principal')

@section('content')
<br>
  <div class="jumbotron">
    <h1 class="display-4"> Usuários</h1>
  </div>

@if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif
<div class="row">
         <table class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Perfil</th>
                  <th>Ativo</th>
                  <th>Apagar/Ativar</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Perfil</th>
                  <th>Ativo</th>
                  <th>Apagar/Ativar</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($usuarios as $u)
              <tr>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->perfil}}</td>
                <td>@if($u->active == 1) Sim @else Não @endif</td>
                @if($u->active == 2)
                <form action="{{ action('UsuarioController@ativar') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$u->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-success" >Ativar</button></td>
                @else
                <form action="{{ action('UsuarioController@apaga') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$u->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger" >Apagar</button></td>
                @endif
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection