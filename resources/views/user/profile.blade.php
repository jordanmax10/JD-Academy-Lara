@extends('_layouts.user')

@section('content')
    <div
        class="max-w-3xl mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow-xl dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white text-center mb-6">
            Perfil de <span class="text-orange-500">Usuario</span>
        </h2>

        <!-- Mostrar mensaje de éxito o error usando el componente -->
        <x-alert-message type="success" message="{{ session('success') }}" />
        <x-alert-message type="error" message="{{ $errors->first() }}" />

        <div class="flex flex-col items-center">
            <!-- Imagen de perfil -->
            <div class="mb-6 flex justify-center">
                <img src="{{ asset('storage/' . Auth::user()->url_img) }}" alt="Imagen de Perfil del Usuario"
                    class="h-32 w-32 object-cover rounded-full border-4 border-green-500 shadow-lg dark:border-gray-700">
            </div>

            <!-- Información del Usuario -->
            <div class="w-full space-y-4 text-center">
                <div class="text-lg font-semibold text-gray-800 dark:text-white">
                    <span class="text-gray-600 dark:text-gray-300">Nombre y Apellido:</span>
                    <p class="mt-1 text-xl">{{ Auth::user()->name }}</p>
                </div>

                <div class="text-lg font-semibold text-gray-800 dark:text-white">
                    <span class="text-gray-600 dark:text-gray-300">Correo Electrónico:</span>
                    <p class="mt-1 text-xl">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Botón para editar perfil -->
            <div class="mt-8 flex gap-3">
                <a href="{{ route('user.profile.edit') }}"
                    class="inline-block px-6 py-3 bg-gradient-to-r from-green-400 via-green-500 to-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-gradient-to-br focus:outline-none focus:ring-2 focus:ring-green-300 dark:focus:ring-green-800 transition duration-200 ease-in-out">
                    Actualizar Perfil
                </a>
                <form action="{{ route('user.destroy', Auth::user()) }}" method="post"
                    onsubmit="return confirm('Estas Seguro de Eliminar tu Cuenta?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-block px-6 py-3 bg-gradient-to-r from-red-400 via-red-500 to-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-gradient-to-br focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-800 transition duration-200 ease-in-out">Eliminar Mi Perfil</button>
                </form>
            </div>
        </div>
    </div>
@endsection
