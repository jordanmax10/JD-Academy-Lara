@extends('_layouts.app')

@section('title', 'Panel Admin | Perfil')

@section('content_header_title')
    Panel Admin
@section('content_header_subtitle')
    Perfil de Usuario
@stop
@stop

@section('content')
<div class="container">

    <div class="card text-center">
        <div class="card-header text-center">
            <h2 style="font-size: 2.25rem;line-height: 2.5rem;font-weight: 800;">Información de <span
                    style="color: #ff5a1f;">tu perfil</span></h2>
            <img style="object-fit: cover;width: 250px;height: 250px;border-radius: 9999px;border: 4px solid #0e9f6e;"
                src="{{ asset('storage/' . Auth::user()->url_img) }}" alt="imagen">
        </div>

        <div class="card-body">
            <p><strong>Nombre y Apellido: </strong>{{ Auth::user()->name }}</p>
            <p><strong>Correo Electronico: </strong>{{ Auth::user()->email }}</p>
            <p><strong>Rol: </strong>{{ Auth::user()->roles->pluck('name')->implode(', ') }}</p>
        </div>
        <div class="card-footer" style="display:flex; margin:10px auto;">
            <a href="{{ route('admin-profile.edit', Auth::user()) }}" class="btn btn-success">Actualizar Perfil</a>
            <form action="{{ route('admin-profile.destroy', Auth::user()) }}" method="post" style="margin: 0px 10px"
                onsubmit="return confirm('Estas Seguro de Eliminar tu Cuenta?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Eliminar Mi Perfil</button>
            </form>
            <a href="{{ route('courses.index') }}" class="btn btn-primary">Volver a Cursos</a>
        </div>
    </div>
</div>
@endsection
