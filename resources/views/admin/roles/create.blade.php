@extends('_layouts.app')

@section('title', 'Panel Admin | Roles')

@section('content_header_title')
    <h1>Crear Nuevo Rol</h1>
@stop

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin-role.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div>
        </div>
    </div>

    <form action="{{ route('admin-role.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Título del curso</label>
            <input type="text" name="name" class="form-control" id="name"
                placeholder="Ingrese el Nombre del Nuevo Rol">

                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
        </div>

        <h2 class="h3">Lista de Permisos</h2>
        @forelse ($permissions as $permission)
           <div>
            <label for="permissions[]"> 
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-1">
                {{ $permission->description }}
            </label>
           </div>
            @empty
        @endforelse

        <button type="submit" class="btn btn-primary">Crear Rol</button>
    </form>
@endsection
