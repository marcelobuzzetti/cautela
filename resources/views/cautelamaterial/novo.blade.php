@extends('layout.principal')

@section('content')

<form action="{{ action('CautelaMaterialController@adiciona') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <div class="form-group">
    <label>Cautela</label>
    @foreach ($cautela as $c)
    <input name="cautela" value="{{$c->id}}" type="hidden">
    <p>Número {{$c->id}} - Militar {{$c->nome}}</p>
    @endforeach
  </div>
  <div class="form-group">
    <label>Material</label>
    <select class="custom-select" id="material" name="material" required="required">
      <option value="" selected disabled>Selecione o Material</option>
      @foreach ($materiais as $m)
        <option value="{{$m->id}}">{{$m->nome}}</option>
      @endforeach
    </select>
  </div>
   <div class="form-group">
    <label>Quantidade</label>
    <input type="number"  min="1" id="quantidade" name="quantidade" placeholder="Digite a quantidade">
  </div>
  <div class="form-group">
    <label>Data Cautela</label>
    <input type="date" name="data_cautela">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Entregar</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Entregar</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($cautelados as $c)
              <tr>
                <td>{{$c->nome}}</td>
                <td>{{$c->data_cautela}}</td>
                <td>{{$c->quantidade}}</td>
                @if($c->data_entrega == NULL)
                <form action="{{ action('CautelaMaterialController@entrega') }}" method="post">
                  <input name="cautela" value="{{$c->cautela}}" type="hidden">
                  <input type="hidden" id="id" name='id' value="{{$c->id}}"/>
                  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                <td><button type="submit" class="btn btn-danger">Entregar</button></td>
                </form>
                @else
                <td>Entregue em {{$c->data_entrega}}</td>
                @endif
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>
     <!-- <div class="row">
         <table  class="table table-striped table-hover table-bordered dt-responsive" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Entregue em</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>Material</th>
                  <th>Data de Cautela</th>
                  <th>Quantidade</th>
                  <th>Entregue em</th>
              </tr>
            </tfoot>

            <tbody>
            @foreach ($entregues as $e)
              <tr>
                <td>{{$e->nome}}</td>
                <td>{{$e->data_cautela}}</td>
                <td>{{$e->quantidade}}</td>
                <td>{{$e->data_entrega}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>  
      </div>-->
      </body>
@endsection