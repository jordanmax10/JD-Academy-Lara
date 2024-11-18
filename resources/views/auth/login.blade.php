@extends('_layouts.basic')

@section('content')
    <div class="p-5 max-w-sm mx-auto">
        <h2 class="flex justify-center text-3xl font-extrabold text-gray-900 dark:text-white mb-8">Iniciar sesión</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Correo Electronico</label>
                <input type="email" id="email" name="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="name@gmail.com" required />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-extrabold text-gray-900 dark:text-white">Contraseña</label>
                <input type="password" id="password" name="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-center">

            <button type="submit"
                class="w-10/12 text-gray-900 bg-gradient-to-r from-teal-200 via-teal-400 to-teal-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Ingresar</button>
            </div>
        </form>
        @if (Route::has('register'))
            <div class="mt-3 font-extrabold text-gray-900 dark:text-white mb-8">
                <a href="{{ route('register') }}">¿Nó tienes Cuenta? <span class="text-orange-500">Registrate!</span></a>
            </div>
        @endif
        <div class="mt-3 text-center font-extrabold text-gray-900 dark:text-white mb-8 ">
            <a href="{{ route('home') }}"> Regresar</a>
        </div>
    </div>
@endsection
