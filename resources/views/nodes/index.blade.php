@extends('master')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1>Mis Nodos</h1>
    <a class="btn btn-primary" href="/panel/nodos/crear">
      Nuevo Nodo
    </a>
    <table class="table" id="nodes">
      <thead>
        <tr>
          <th class="col-md-1">#</th>
          <th class="col-md-6">Nombre</th>
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
            <a href="/panel/nodos/{{$node->id}}/editar">Editar</a>
          </td>
          <td>
            <a href="javascript:void(0)" data-type="delete" data-id={{$node->id}}>Borrar</a>
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
$('a[data-type=delete]').on('click', function(e) {
  if (!confirm('Esta seguro que desea eliminar este nodo?')) { return; }
  var nodeId = e.currentTarget.dataset.id;
  var csrfTokenData = '_token=' + $('#global_crsf_token').val();

  // Laravel to protect from csrf waits for a _token field for each non-get request
  // this _token is saved on session, that's why it can be accessed globally by DOM
  $.ajax('/panel/nodos/' + nodeId, {
    type: 'DELETE',
    data: csrfTokenData
  }).then(function() {
    alert('Nodo eliminado exitosamente');
    window.location = '/panel';
  }, function(err) {
    alert('Hubo un problea al eliminar el nodo');
  })
});
</script>
@endsection
