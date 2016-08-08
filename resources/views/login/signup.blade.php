@extends('master')

@section('content')
<div class="row">
  <div class="col-md-3 col-md-offset-4">
    <h2>Registro de nuevo usuario</h2>
    <form method="post" class="form">
      {{ csrf_field() }}
      <div class="form-group">
        <label>Nombre</label>
        <input name="name" class="form-control" placeholder="Tu nombre" autocomplete="off" />
      </div>
      <div class="form-group">
        <label>Correo Electrónico</label>
        <input type="text" name="email" class="form-control" placeholder="Tu correo electronico" autocomplete="off" />
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" autocomplete="off" />
      </div>
      <div class="form-group">
        <label>Confirmar Password</label>
        <input type="password" name="confirm" class="form-control" autocomplete="off" />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">
          Completar Registro
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
