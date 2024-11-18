@extends('_layouts.basic')

@section('content')
    <div class="p-5 max-w-sm mx-auto">
        <h2 class="flex justify-center text-3xl font-extrabold text-gray-900 dark:text-white mb-8">Registrarse</h2>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Nombre y Apellido</label>
                <input type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Correo
                    electrónico</label>
                <input type="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password"
                    class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Contraseña</label>
                <input type="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation"
                    class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Confirmar contraseña</label>
                <input type="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="mb-3">
                <label class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white" for="file_input">Foto de
                    Perfil</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="file_input_help" name="imagenProfile" type="file">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX.
                    800x400px).</p>
            </div>


            <div class="flex justify-center">
                <button type="submit"
                    class=" w-10/12 text-gray-900 bg-gradient-to-r from-teal-200 via-teal-400 to-teal-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Registrar</button>
            </div>
        </form>

        @if (Route::has('login'))
            <div class="mt-3 font-extrabold text-gray-900 dark:text-white mb-8">
                <a href="{{ route('login') }}">¿Ya tienes una cuenta? <span class="text-orange-500"> Inicia sesión
                    </span></a>
            </div>
        @endif
        <div class="mt-3 text-center font-extrabold text-gray-900 dark:text-white mb-8 ">
            <a href="{{ route('home') }}"> Regresar</a>
        </div>
    </div>
@endsection
