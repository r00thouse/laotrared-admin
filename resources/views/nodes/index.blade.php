@extends('master')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1>Nodos</h1>
    <a class="btn btn-primary" href="/panel/nodos/crear">
      Nuevo Nodo
    </a>
    <table class="table" id="nodes">
      <thead>
        <tr>
          <th class="col-md-1">#</th>
          <th class="col-md-6">Nombre</th>
          <th class="col-md-2">Departamento</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
    @foreach($nodes as $node)
        <tr>
          <td>
            {{ $node->id }}
          </td>
          <td>
            {{ $node->name }}
          </td>
          <td>
            @city($node->city)
          </td>
          <td>
            <a href="/panel/nodos/{{$node->id}}/editar">Editar</a>
          </td>
          <td>
            <a href="#">Borrar</a>
          </td>
        </tr>
    @endforeach
      </tbody>
    </table>
    {!! $nodes->render() !!}
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection
