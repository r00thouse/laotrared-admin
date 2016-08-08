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

@section('styles')
<style type="text/css" media="screen">
  .network-list {
    margin: 10px 10px 10px 0;
    padding: 0;
  }
  .network-list .network {
    width: 280px;
    display: inline-block;
    height: 180px;
    background: #AFBA98;
    padding: 10px;
    margin-right: 15px;
    margin-bottom: 15px;
    vertical-align: top;
  }
  .network h3 {
    margin: 0;
  }
  .network .content {
    overflow: hidden;
    text-overflow: ellipsis;
    height: 85px;
  }
</style>
@endsection
