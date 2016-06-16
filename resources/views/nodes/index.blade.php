@extends('master')

@section('content')
<table class="table" id="nodes">
  <thead>
    <tr>
      <th>#</th>
    </tr>
    <tr>
      <th>Nombre</th>
    </tr>
    <tr>
      <th></th>
    </tr>
    <tr>
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
        <a href="/panel/nodos/{{$node->id}}/editar">Editar</a>
      </td>
      <td>
        <a href="#">Borrar</a>
      </td>
    </tr>
@endforeach
  </tbody>
</table>
@endsection

@section('scripts')
<script type="text/javascript">
</script>
@endsection
