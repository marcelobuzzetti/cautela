@extends('layout.principal')

@section('content')
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Número</th>
                  <th>Militar</th>
                  <th>Data da Cautela</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Número</th>
                  <th>Militar</th>
                  <th>Data da Cautela</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelas as $c)
              <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->nome}}</td>
                <td>{{$c->data_cautela}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection