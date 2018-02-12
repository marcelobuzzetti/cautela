@extends('layout.principal')

@section('content')

<form action="{{ action('UsuarioController@atualiza') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <input type="hidden" name="id" value="{{ $u->id }}"/>
  <div class="form-group" >
    <label>Nome</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do Militar" required="required" value="{{$u->name}}">
  </div>
  <div class="form-group" >
    <label>E-mail</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Digite o nome do Militar" required="required" value="{{$u->email}}">
  </div>
  <div class="form-group">
    <label>Perfil</label>
    <select class="custom-select" id="perfil" name="perfil" required="required">
      <option value="" selected disabled>Selecione um perfil</option>
      @foreach ($perfil as $p)
        <option value="{{$p->id}}" @if($p->id == $u->perfil) selected @endif>{{$p->nome}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection