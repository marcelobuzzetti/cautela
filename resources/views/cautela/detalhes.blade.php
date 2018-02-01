@extends('layout.principal')

@section('content')
<div class="form-group">
    <label>Cautela</label>
    @foreach ($cautela as $c)
    <input name="cautela" value="{{$c->id}}" hidden="hidden">
    <p>Número {{$c->id}} - Militar {{$c->nome}}</p>
    @endforeach
  </div>
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelados as $c)
              <tr>
                <td>{{$c->nome}}</td>
                <td>{{$c->data_cautela}}</td>
                <td>{{$c->quantidade}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>