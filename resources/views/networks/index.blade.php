@extends('master')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1>Redes</h1>
  @permission('create_network')
    <a class="btn btn-primary" href="/panel/redes/crear">
      Nueva Red
    </a>
  @endpermission
    <div class="network-list">
    @foreach($networks as $network)
      <div class="network">
        <h3>{{ $network->name }}</h3>
        <div class="content">
          {{ $network->description }}
        </div>
        <div class="bar">
          <a href="/panel/redes/{{$network->id}}/editar">Editar</a>
          <a href="/panel/redes/{{$network->id}}/admin">Administrar</a>
        </div>
      </div>
    @endforeach
    </div>
    {!! $networks->render() !!}
  </div>
</div>
@endsection
