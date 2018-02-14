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
    <label>Posto/Grad</label>
    <select class="custom-select" id="patente" name="patente" required="required">
      <option value="" disabled>Selecione o Posto/Grad</option>
      @foreach ($postos as $p)
        <option value="{{$p->id}}" {{ $p->id == $m->patente ? "selected" : ''}}>{{$p->patente}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Nome de Guerra</label>
    <input type="text" class="form-control" id="nome_guerra" name="nome_guerra" placeholder="Digite o Nome de Guerra" required="required" value="{{$m->nome_guerra}}">
  </div>
   <div class="form-group">
    <label>Telefone</label>
    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o Telefone" required="required" value="{{ $m->telefone }}">
  </div>
  <div class="form-group">
    <label>E-mail</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Digite o E-mail" required="required" value="{{ $m->email}}">
  </div>
  <div class="form-group" >
    <label>Pelotão</label>
    <input type="text" class="form-control" id="pelotao" name="pelotao" placeholder="Digite o pelotao do Militar" required="required" value="{{$m->pelotao}}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection