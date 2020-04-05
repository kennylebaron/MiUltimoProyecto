@extends('layouts.main')
@section('contenido')
<style> 
    .input-icons i { 
        position: absolute; 
    }  
    .input-icons { 
        width: 100%; 
        margin-bottom: 10px; 
    }  
    .icon { 
        padding: 10px; 
        color: gray; 
        min-width: 50px; 
        text-align: center; 
    }  
</style> 
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Vinos</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalAgregar">
    <i class="fas fa-plus"></i> Agregar Vino</a>
</div>
<div class="row">
    @if($message = Session::get('Listo'))
        <div class="col-12 alert alert-success alert-dismissable fade show" role="alert">
            <span>{{ $message }}</span>
        </div>
    @endif
    <table class="table col-12">
        <thead class="thead-dark">
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Edad</td>
                <td>Color</td>
                <td>Sabor (Nivel de Azucar)</td>
                <td>Nivel de Alcohol</td>
                <td>Precio</td>
                <td>Stock</td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @foreach($vinos as $vino)
                <tr>
                    <td>{{ $vino->id }}</td>
                    <td>{{ $vino->nombre }}</td>
                    <td>{{ $vino->edad }}</td>
                    <td>{{ $vino->color }}</td>
                    <td>{{ $vino->sabor }}</td>
                    <td>{{ $vino->alcohol }}</td>
                    <td>{{ $vino->precio }}</td>
                    <td>{{ $vino->stock }}</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Agregar Vino</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/admin/vinos" method="post">
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
                <select class="form-control" name="edad">
                    <option value="" disabled selected>Edad</option>
                    <option value="5-9 años">5-9 años</option>
                    <option value="10-14 años">10-14 años</option>
                    <option value="15-19 años">15-19 años</option>
                    <option value="20-24 años">20-24 años</option>
                    <option value="25-29 años">25-29 años</option>
                    <option value="Dulce (<50gr x lt.)">30+ años</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="color">
                    <option value="" disabled selected>Color</option>
                    <option value="Tinto">Tinto</option>
                    <option value="Púrpura">Púrpura</option>
                    <option value="Rosado">Rosado</option>
                    <option value="Ámbar">Ámbar</option>
                    <option value="Dorado">Dorado</option>
                    <option value="Blanco">Blanco</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="sabor">
                    <option value="" disabled selected>Sabor (Nivel de azucar)</option>
                    <option value="Seco (sin azucar)">Seco (sin azucar)</option>
                    <option value="Abocado (>3 gr. x lt.)">Abocado (>3 gr. x lt.)</option>
                    <option value="Semiseco (>6 gr. x lt.)">Semiseco (>6 gr. x lt.)</option>
                    <option value="Semidulce (>15 gr. x lt.)">Semidulce (>15 gr. x lt.)</option>
                    <option value="Dulce (33-50 gr. x lt.)">Dulce (33-50 gr. x lt.)</option>
                    <option value="Dulce natural (<50 gr. x lt.)">Dulce natural (+50 gr. x lt.)</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control text-right" name="alcohol">
                    <option value="" disabled selected>Nivel de Alcohol</option>
                    <option value=">12.5%">12.5%</option>
                    <option value="12.5% - 13.5%">12.5% - 13.5%</option>
                    <option value="13.5% - 14.5%">13.5% - 14.5%</option>
                    <option value="14.5+">14.5+</option>
                </select>
            </div>
            <div class="input-icons"> 
                <i class="fas fa-dollar-sign float-left icon"></i>
                <input class="form-control text-right input-field" type="text" name="precio" placeholder="Precio" value="{{ old('precio') }}"> 
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