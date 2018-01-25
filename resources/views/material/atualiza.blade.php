@extends('layout.principal')

@section('content')

<form action="{{ action('MaterialController@adiciona') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <input type="hidden" name="id" value="{{ $m->id }}"/>
  <div class="form-group" >
    <label>Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do Material" required="required" value="{{$m->nome}}">
  </div>
  <div class="form-group">
    <label>Valor</label>
    <input type="number" step="0.01" min="0.01" class="form-control" id="valor" name="valor" placeholder="Digite o Valor" required="required" value="{{$m->valor}}">
  </div>
  <div class="form-group">
    <label>Descrição</label>
    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a Descrição" required="required" value="{{$m->descricao}}">
  </div>
  <div class="form-group">
    <label>Quantidade</label>
    <input type="number" class="form-control" min="1" id="quantidade" name="quantidade" placeholder="Digite a Quantidade" required="required" value="{{$m->quantidade}}">
  </div>
  <div class="form-group">
    <label>Reserva</label>
    <select class="custom-select" id="reserva" name="reserva" required="required">
      <option value="" disabled>Selecione uma reserva</option>
      @foreach ($reservas as $r)
        <option value="{{$r->id}}" {{ $r->id == $m->reserva ? "selected" : ''}}>{{$r->nome}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection