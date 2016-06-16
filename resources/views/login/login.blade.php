@extends('master')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-3">
      <h1>Inicio de Sesión</h1>
      <form method="post" accept-charset="utf-8" class="form">
        {{ csrf_field() }}
        <div class="form-grpup">
          <label>Email:</label>
          <input type="email" class="form-control" autocomplete="off" name="email" placeholder="juan@ejemplo.com" />
        </div>
        <div class="form-group">
          <label>Password:</label>
          <input type="password" class="form-control" autocomplete="off" name="password">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">
            Login
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
