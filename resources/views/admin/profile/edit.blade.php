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
        <h2 style="font-size: 2.25rem;line-height: 2.5rem;font-weight: 800;">
            Actualizar el Perfil
            <span style="color: #ff5a1f;"> del Usuario</span>
        </h2>
        </div>
        <!-- Mostrar mensaje de éxito o error usando el componente -->
        <x-alert-message type="success" message="{{ session('success') }}" />
        <x-alert-message type="error" message="{{ $errors->first() }}" />

        <form method="POST" action="{{ route('admin-profile.update', Auth::user()) }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Contenedor para la imagen y el formulario -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Sección de la Imagen de Perfil -->
                <div class="flex justify-center items-center">
                    <div style="overflow:hidden">
                        <img id="image-preview" src="{{ asset('storage/' . Auth::user()->url_img) }}"
                            alt="Imagen de Perfil" style="object-fit: cover;width: 250px;height: 250px;border-radius: 9999px;border: 4px solid #0e9f6e;">
                    </div>
                    <div class="mt-4 text-center">
                        <label for="image" class="form-label">Cambiar foto de
                            perfil</label>
                        <input type="file" id="image" name="image" accept="image/*" class="hidden"
                            onchange="previewImage(event)">
                    </div>
                </div>

                <!-- Formulario de Datos del Usuario -->
                <div>
                    <!-- Campo de Nombre -->
                    <div class="form-group">
                        <label for="name"
                            class="form-label">Nombre y
                            Apellido</label>
                        <input type="text" id="name" name="name"
                            value="{{ old('name', Auth::user()->name) }}"
                            class="form-control"
                            required autofocus>
                        @error('name')
                            <div class="invalid-feedback text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Correo Electrónico -->
                    <div class="form-group">
                        <label for="email"
                            class="form-label">Correo
                            Electrónico</label>
                        <input type="email" id="email" name="email"
                            value="{{ old('email', Auth::user()->email) }}"
                            class="form-control"
                            required autofocus>
                        @error('email')
                            <div class="invalid-feedback text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Contraseña (opcional) -->
                    <div class="mb-4">
                        <label for="password"
                            class="form-label">Nueva Contraseña
                            (opcional)</label>
                        <input type="password" id="password" name="password"
                            class="form-control">
                        @error('password')
                            <div class="invalid-feedback text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="form-group">
                        <label for="password_confirmation"
                            class="form-label">Confirmar Nueva
                            Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control">
                    </div>

                    <!-- Botón de Guardar Cambios -->
                    <div class="my-4">
                        <button type="submit"
                            class="btn btn-success">
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Función para mostrar la vista previa de la imagen seleccionada
    function previewImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        var preview = document.getElementById('image-preview');

        if (file) {
            reader.readAsDataURL(file);
            reader.onload = function() {
                preview.src = reader.result;
                preview.classList.remove('hidden'); 
            };
        }
    }
</script>
@endsection
