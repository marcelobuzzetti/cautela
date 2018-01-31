@extends('layout.principal')

@section('content')
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Número</th>
                  <th>Militar</th>
                  <th>Data da Cautela</th>
                  <th>Cautelar Material</th>
                  <th>Visualizar Cautela</th>
                  <th>Apagar</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Número</th>
                  <th>Militar</th>
                  <th>Data da Cautela</th>
                  <th>Cautelar Material</th>
                  <th>Visualizar Cautela</th>
                  <th>Apagar</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelas as $c)
              <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->nome}}</td>
                <td>{{$c->data_cautela}}</td>
                 <form action="{{ action('CautelaMaterialController@novo') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-success">Cautelar Material</button></td>
              </form>
               <form action="{{ action('CautelaController@detalhes') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-info">Visualizar Cautela</button></td>
              </form>
                <form action="{{ action('CautelaController@apaga') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger">Apagar</button></td>
              </form>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection