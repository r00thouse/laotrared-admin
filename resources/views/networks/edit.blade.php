@extends('master')

@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <h1>Información de la Red</h1>
    <form method="post" accept-charset="utf-8" class="form" id="network-form">
      {{csrf_field()}}
      {{method_field($method)}}
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control" name="name" type="text" placeholder="Nombre de la red..." autocomplete="off" value="{{$model->name}}" />
      </div>
    @if($method === 'post')
      <div class="form-group">
        <label>Administrador</label>
        {{-- Get a list of users --}}
        <select name="owner" class="form-control">
        @foreach($users as $user)
          <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
        </select>
      </div>
    @endif
      <div class="form-group">
        <label>Descripción</label>
        <textarea name="description" class="form-control" rows="4">{{$model->description}}</textarea>
      </div>
      <div class="form-group">
        <label>Características</label>
        <textarea name="features" class="form-control" rows="4">{{$model->features}}</textarea>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">
          Guardar Cambios
        </button>
        &nbsp;
      @if($method === 'put')
        <button type="button" class="btn btn-danger" id="delete" data-id="{{$model->id}}">
          Eliminar
        </button>
      @endif
        <a href="/panel/redes">Volver</a>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
  $('#delete').on('click', function(e) {
    if (!confirm('Esta seguro que desea eliminar este red?')) { return; }

    var networkId = e.currentTarget.dataset.id;
    var csrfTokenData = '_token=' + $('#global_crsf_token').val();

    $.ajax('/panel/redes/' + networkId, {
      type: 'DELETE',
      data: csrfTokenData
    }).then(function() {
      alert('Red eliminada exitosamente');
      window.location = '/panel/redes/';
    }, function(err) {
      alert('Hubo un problea al eliminar esta red');
    })

  });
});
</script>
@endsection
