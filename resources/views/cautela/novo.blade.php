@extends('layout.principal')

@section('content')

<form action="{{ action('CautelaController@adiciona') }}" method="post">
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
  <div class="form-group">
    <label>Militar</label>
    <select class="custom-select" id="militar" name="militar" required="required">
      <option value="" selected disabled>Selecione um Militar</option>
      @foreach ($militares as $m)
        <option value="{{$m->id}}"> {{$m->nome_guerra}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Data</label>
    <input type="date" name="data_cautela">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection