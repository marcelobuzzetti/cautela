@extends('layout.principal')

@section('content')

<form action="{{ action('PelotaoController@adiciona') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <div class="form-group" >
    <label>Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do Pelotão" required="required" value="{{ old('nome') }}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection