@extends('layout.principal')

@section('content')

<form action="{{ action('MilitarController@adiciona') }}" method="post">
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
  <div class="form-group" >
    <label>OM/Pelotão</label>
    <input type="text" class="form-control" id="pelotao" name="pelotao" placeholder="Digite o OM/Pelotão do Militar" required="required" value="{{ old('pelotao') }}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection