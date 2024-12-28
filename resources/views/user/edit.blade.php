@extends('_layouts.user')

@section('content')
    <div class="p-5 max-w-4xl mx-auto w-full bg-gray-300 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 md:w-full">
        <h2 class="flex justify-center flex-col items-center mb-5 text-3xl font-extrabold text-gray-900 dark:text-white">
            Actualizar el Perfil 
            <span class="text-orange-500 ml-2"> del Usuario</span>
        </h2>

        <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Contenedor para la imagen y el formulario -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Sección de la Imagen de Perfil -->
                <div class="flex justify-center items-center">
                    <div class="w-40 h-40 bg-gray-200 rounded-full overflow-hidden">
                        <img id="image-preview" src="{{ asset('storage/' . Auth::user()->url_img) }}" alt="Imagen de Perfil"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="mt-4 text-center">
                        <label for="image" class="text-sm text-blue-500 font-medium cursor-pointer">Cambiar foto de perfil</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="hidden" onchange="previewImage(event)">
                    </div>
                </div>

                <!-- Formulario de Datos del Usuario -->
                <div>
                    <!-- Campo de Nombre -->
                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Nombre y Apellido</label>
                        <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required autofocus>
                        @error('name')
                            <div class="invalid-feedback text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Correo Electrónico -->
                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required autofocus>
                        @error('email')
                            <div class="invalid-feedback text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Contraseña (opcional) -->
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Nueva Contraseña (opcional)</label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @error('password')
                            <div class="invalid-feedback text-red-500 text-xs">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Confirmar Nueva Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <!-- Botón de Guardar Cambios -->
                    <div class="flex flex-col mt-4">
                        <button type="submit"
                            class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </form>
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
                        preview.classList.remove('hidden');  // Mostrar la imagen
                    };
                }
            }
        </script>
@endsection
