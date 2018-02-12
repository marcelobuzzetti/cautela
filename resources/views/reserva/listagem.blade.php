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
                  <th>Atualizar</th>
                  <th>Apagar</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Nome</th>
                  <th>Atualizar</th>
                  <th>Apagar</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($reservas as $r)
              <tr>
                <td>{{$r->nome}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection