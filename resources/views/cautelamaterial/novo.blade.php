@extends('layout.principal')

@section('content')

<form action="{{ action('MilitarController@adiciona') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <div class="form-group">
    <label>Cautelas</label>
    <select class="custom-select" id="pelotao" name="pelotao" required="required">
      <option value="" selected disabled>Selecione uma Cautela</option>
      @foreach ($cautelas as $c)
        <option value="{{$c->id}}">Número {{$c->id}} - Militar {{$c->nome}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Material</label>
    <select class="custom-select" id="pelotao" name="pelotao" required="required">
      <option value="" selected disabled>Selecione o Material</option>
      @foreach ($materiais as $m)
        <option value="{{$m->id}}">{{$m->nome}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelados as $c)
              <tr>
                <td>{{$c->nome}}</td>
                <td>{{$c->data_cautela}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
@endsection