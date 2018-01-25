@extends('layout.principal')

@section('content')

<form action="{{ action('MilitarController@adiciona') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <input type="hidden" name="id" value="{{ $m->id }}"/>
  <div class="form-group" >
    <label>Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do Militar" required="required" value="{{$m->nome}}">
  </div>
  <div class="form-group">
    <label>Nome de Guerra</label>
    <input type="text" class="form-control" id="nome_guerra" name="nome_guerra" placeholder="Digite o Nome de Guerra" required="required" value="{{$m->nome_guerra}}">
  </div>
  <div class="form-group">
    <label>Pelotão</label>
    <select class="custom-select" id="pelotao" name="pelotao" required="required">
      <option value="" selected disabled>Selecione um Pelotão</option>
      @foreach ($p as $p)
        <option value="{{$p->id}}" {{ $p->id == $m->pelotao ? "selected" : ''}}>{{$p->nome}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection