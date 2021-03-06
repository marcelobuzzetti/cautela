@extends('layout.principal')

@section('content')

<form action="{{ action('PelotaoController@adiciona') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <input type="hidden" name="id" value="{{ $p->id }}"/>
  <div class="form-group" >
    <label>Pelotão</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do Pelotão" required="required" value="{{$p->nome}}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection