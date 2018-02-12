@extends('layout.principal')

@section('content')
<div class="row">
         <table class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Perfil</th>
                  <th>Ativo</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Perfil</th>
                  <th>Ativo</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($usuarios as $u)
              <tr>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->perfil}}</td>
                <td>@if($u->active == 1) Sim @else Não @endif</td>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection