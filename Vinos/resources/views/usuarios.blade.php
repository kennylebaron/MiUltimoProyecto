@extends('layouts.main')
@section('contenido')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-green shadow-sm" data-toggle="modal" data-target="#modalAgregar">
    <i class="fas fa-plus"></i></i> Agregar Usuario</a>
</div>
<div class="row">
    @if($message = Session::get('Listo'))
        <div class="col-12 alert alert-success alert-dismissable fade show" role="alert">
            <span>{{ $message }}</span>
        </div>
    @endif
    <table class="table col-12">
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Email</td>
                <td>Nivel</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->nivel }}</td>
                    <td>
                        <button class="btn btn-round"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/admin/usuarios" method="post">
      @csrf  
      <div class="modal-body">
        @if($message = Session::get('ErrorInsert'))
            <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
                <h5>Errores: </h5>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="form-group">
                <input type="text"class="form-control" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}">
            </div>
            <div class="form-group">
                <input type="email"class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <input type="password"class="form-control" name="pass1" placeholder="Contraseña">
            </div>
            <div class="form-group">
                <input type="password"class="form-control" name="pass2" placeholder="Confirmar Contraseña">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            @if($message = Session::get('ErrorInsert'))
            $("#modalAgregar").modal('show');
            @endif
        });
    </script>
@endsection