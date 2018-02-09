@extends('layout.principal')

@section('content')
@if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Número</th>
                  <th>Militar</th>
                  <th>Data da Cautela</th>
                  <th>Cautelar Material</th>
                  <th>Visualizar Cautela</th>
                  <th>Encerrar Cautela</th>
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
                  <th>Encerrar Cautela</th>
                  <th>Apagar</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelas as $c)
              <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->nome}}</td>
                <td>{{$c->data_cautela}}</td>
                @if($c->data_entrega)
               <td>Cautela Encerrada</td>
               @else
                 <form action="{{ action('CautelaMaterialController@novo') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-success" >Cautelar Material</button></td>
              </form>
              @endif
               <form action="{{ action('CautelaController@detalhes') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-info">Visualizar Cautela</button></td>
              </form>
              @if($c->data_entrega)
               <td>Encerrada em {{$c->data_entrega}}</td>
               @else
              <form action="{{ action('CautelaController@encerra') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn">Encerrar Cautela</button></td>
              </form>
              @endif
                <form action="{{ action('CautelaController@apaga') }}" method="post">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger"  @if(Auth::user()->perfil != 1) disabled @endif>Apagar</button></td>
              </form>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection