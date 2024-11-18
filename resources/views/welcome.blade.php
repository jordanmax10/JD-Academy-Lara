<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JD-Academia-Lara | Inicio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white">

    {{-- MENU NAVEGACION --}}
    <header>
        <nav
            class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b mb-10 border-gray-200 dark:border-gray-600">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('storage/img/gestion.png') }}" class="h-10" alt="JD-Academy Logo">
                    <span class="text-2xl font-semibold text-teal-500 dark:text-teal-300">JD-Academy</span>
                </a>
                <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    @if (Route::has('login'))
                        <div class="flex space-x-3">
                            @auth
                                <a href="{{ route('courses.index') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Cursos</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Acceder</a>
                            @endauth
                        </div>
                    @endif
                    <button data-collapse-toggle="navbar-sticky" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only"></span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                    <ul
                        class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="{{ route('home') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#aboutMe"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    {{-- FIN DEL MENU NAVEGACION --}}

    {{-- Sección 1: Bienvenida --}}
    <section
        class="flex flex-col md:flex-row items-center justify-between p-8 mt-24 bg-gradient-to-r from-teal-100 via-teal-200 to-teal-300 dark:from-teal-700 dark:via-teal-800 dark:to-teal-900 rounded-xl shadow-xl">
        <div class="w-full md:w-1/2 text-center md:text-left">
            <h1 class="text-4xl font-extrabold text-gray-800 dark:text-white mb-4">
                Bienvenido a JD-Academy
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                JD-Academy es una plataforma educativa que te permite gestionar usuarios, roles y permisos de forma
                fácil y segura.
                Aprende todo lo necesario para administrar el acceso a tus aplicaciones.
            </p>
            <a href="{{ route('register') }}">
                <button
                    class="text-white bg-teal-500 hover:bg-teal-600 transition duration-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Registrarte
                </button>
            </a>
        </div>
        <div class="w-full md:w-1/2 mt-8 md:mt-0">
            <img src="https://via.placeholder.com/500" alt="Imagen principal"
                class="w-full h-auto rounded-lg shadow-lg">
        </div>
    </section>

    {{-- Sección 2: Sistema de Cursos Online --}}
    <section class="p-8 bg-teal-200 dark:bg-teal-900 rounded-xl shadow-xl">
        <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-white mb-6">
            Sistema de Cursos Online
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 mb-6 text-center">
            Aprende a gestionar usuarios, roles y permisos dentro de un sistema de cursos online. Domina Laravel y
            controla los accesos de forma efectiva.
        </p>
        <div class="flex flex-col md:flex-row justify-between items-center gap-8">
            <div
                class="max-w-sm p-6 bg-white dark:bg-gray-800 border border-gray-200 rounded-lg shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                <h5 class="mb-2 text-2xl font-semibold text-gray-900 dark:text-white">Gestión de Roles</h5>
                <p class="mb-3 text-gray-500 dark:text-gray-400">Crea, modifica y asigna roles con facilidad utilizando
                    las herramientas de Laravel.</p>
            </div>
            <div
                class="max-w-sm p-6 bg-white dark:bg-gray-800 border border-gray-200 rounded-lg shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                <h5 class="mb-2 text-2xl font-semibold text-gray-900 dark:text-white">Asignación de Permisos</h5>
                <p class="mb-3 text-gray-500 dark:text-gray-400">Define permisos para asegurar que solo los usuarios
                    autorizados accedan a recursos específicos.</p>
            </div>
            <div
                class="max-w-sm p-6 bg-white dark:bg-gray-800 border border-gray-200 rounded-lg shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                <h5 class="mb-2 text-2xl font-semibold text-gray-900 dark:text-white">Cursos Gratis</h5>
                <p class="mb-3 text-gray-500 dark:text-gray-400">Accede a demostraciones y tutoriales gratuitos para
                    comenzar a aprender.</p>
            </div>
        </div>
    </section>

    {{-- Sección 3: Acerca de --}}
    <section id="aboutMe" class="bg-gray-200 dark:bg-gray-800 p-8 rounded-xl shadow-xl mb-8">
        <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-white mb-6">Conoce al Desarrollador</h2>
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="w-full md:w-1/3 text-center">
                <img src="{{ asset('storage/img/developer.jpg') }}" alt="Desarrollador"
                    class="w-32 h-32 rounded-full shadow-lg mx-auto mb-4">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Jordan - Dev</h3>
                <p class="text-lg text-gray-600 dark:text-gray-300">Desarrollador Web Junior en Laravel</p>
            </div>
            <div class="w-full md:w-2/3 text-center md:text-left">
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-4">
                    Soy un apasionado desarrollador web con experiencia en Laravel, Vue.js y Tailwind CSS.
                    <br>Mi misión es ofrecer soluciones tecnológicas que faciliten la vida de las personas.
                </p>
            </div>
        </div>
    </section>

    {{-- Sección 4: Funcionalidades --}}
    <section class="bg-gray-100 dark:bg-gray-900 p-8 rounded-xl shadow-xl mb-8">
        <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-6">Funcionalidades</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Interfaz Intuitiva</h3>
                <p class="text-gray-600 dark:text-gray-300">Un diseño sencillo que te permitirá gestionar todos los
                    accesos de manera clara y eficiente.</p>
            </div>
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Soporte Continuo</h3>
                <p class="text-gray-600 dark:text-gray-300">Disfruta de asistencia técnica mientras exploras nuestras
                    herramientas y funcionalidades.</p>
            </div>
            <div
                class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Integración con Laravel</h3>
                <p class="text-gray-600 dark:text-gray-300">Potente integración con Laravel que facilita la gestión de
                    permisos y usuarios en tus proyectos.</p>
            </div>
        </div>
    </section>

    {{-- Sección 5: Contacto --}}
    <section id="contact" class="bg-gray-100 dark:bg-gray-800 p-8 rounded-xl shadow-xl mb-8">
        <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-6">Contacto</h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 text-center mb-6">Si tienes alguna pregunta, no dudes en
            ponerte en contacto con nosotros.</p>
        <div class="max-w-lg mx-auto bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
            <form action="#" method="POST">
                <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input type="text" id="name" name="name"
                    class="w-full p-3 border rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-600 mb-4">

                <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">Correo
                    Electrónico</label>
                <input type="email" id="email" name="email"
                    class="w-full p-3 border rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-600 mb-4">

                <label for="message" class="block text-sm font-medium text-gray-900 dark:text-white">Mensaje</label>
                <textarea id="message" name="message"
                    class="w-full p-3 border rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-600 mb-4"></textarea>

                <button type="submit"
                    class="w-full text-white bg-teal-500 hover:bg-teal-600 font-medium rounded-lg text-sm px-5 py-2.5">Enviar</button>
            </form>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-teal-900 text-white py-6">
        <div class="max-w-screen-xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} JD-Academy. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>
