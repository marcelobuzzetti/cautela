@extends('layout.principal')

@section('content')
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Militar</th>
                  <th>Material</th>
                  <th>Quantidade</th>
                  <th>Data da Cautela</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Militar</th>
                  <th>Material</th>
                  <th>Quantidade</th>
                  <th>Data da Cautela</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelas as $c)
              <tr>
                <td>{{$c->nome}}</td>
                <td>{{$c->material}}</td>
                <td>{{$c->quantidade}}</td>
                <td>{{$c->data_cautela}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection