@extends('layout.principal')

@section('content')
<br>
<div class="jumbotron">
    <h1 class="display-4">Cadastre a Cautela</h1>
  </div>
<form action="{{ action('CautelaController@adiciona') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <div class="form-group">
    <label>Militar</label>
    <select class="js-example-responsive custom-select" id="militar" name="militar" required="required">
      <option value="" selected disabled>Selecione um Militar</option>
      @foreach ($militares as $m)
        <option value="{{$m->id}}">{{$m->patente}} {{$m->nome_guerra}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Data</label>
    <input type="date" name="data_cautela" class="form-control" required="required">
  </div>
  @if(Auth::user()->perfil == 1)
   <div class="form-group">
    <label>Reserva</label>
    <select class="custom-select" id="reserva" name="reserva" required="required">
      <option value="" selected disabled>Selecione a Reserva</option>
      @foreach ($reservas as $r)
        <option value="{{$r->id}}">{{$r->nome}}</option>
      @endforeach
    </select>
  </div>
  @endif
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<br>
<blockquote class="blockquote text-center">
  <p class="mb-0">Não encontrou o militar na lista acima?</p>
  <p class="mb-0">Cadastre-o no formulário abaixo</p>
</blockquote>
<form action="{{ action('MilitarController@adicionacautela') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <div class="form-group" >
    <label>Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do Militar" required="required" value="{{ old('nome') }}">
  </div>
   <div class="form-group">
    <label>Posto/Grad</label>
    <select class="custom-select" id="patente" name="patente" required="required">
      <option value="" selected disabled>Selecione o Posto/Grad</option>
      @foreach ($postos as $p)
        <option value="{{$p->id}}">{{$p->patente}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Nome de Guerra</label>
    <input type="text" class="form-control" id="nome_guerra" name="nome_guerra" placeholder="Digite o Nome de Guerra" required="required" value="{{ old('nome_guerra') }}">
  </div>
  <div class="form-group">
    <label>Telefone</label>
    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o Telefone" required="required" value="{{ old('telefone') }}">
  </div>
  <div class="form-group">
    <label>E-mail</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Digite o E-mail" required="required" value="{{ old('email') }}">
  </div>
  <div class="form-group" >
    <label>OM/Pelotão</label>
    <input type="text" class="form-control" id="pelotao" name="pelotao" placeholder="Digite o OM/Pelotão do Militar" required="required" value="{{ old('pelotao') }}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
