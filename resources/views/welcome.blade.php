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
        <nav class="bg-white dark:bg-gray-900 w-full top-0 start-0 border-b border-gray-200 dark:border-gray-600">
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
                                    class="bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 
                                   hover:bg-gradient-to-br focus:ring-4 focus:outline-none 
                                   focus:ring-orange-300 dark:focus:ring-orange-800 
                                   shadow-lg shadow-orange-500/50 dark:shadow-lg dark:shadow-orange-800/80 
                                   font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Cursos
                                </a>
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
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    {{-- FIN DEL MENU NAVEGACION --}}

    <!-- Sección 1: Bienvenida -->
    <section class="relative bg-teal-300 py-24 px-6 shadow-lg">
        <div
            class="max-w-screen-xl mx-auto flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h1 class="text-5xl font-extrabold text-gray-800">Bienvenido a JD-Academy</h1>
                <p class="text-lg text-gray-950 mt-4 text-justify mr-5">JD-Academy es una plataforma educativa diseñada
                    para la gestión
                    básica de cursos online, como parte de un proyecto de práctica. Este software permite a los usuarios
                    acceder y gestionar cursos de manera sencilla. Con funcionalidades clave como la inscripción de
                    estudiantes a cursos, un panel de administración con
                    roles y permisos, JD-Academy ofrece una experiencia simple y eficaz para tanto estudiantes como
                    administradores. Aunque es un sistema básico, está pensado para facilitar el aprendizaje y gestionar
                    las operaciones diarias de un curso en línea.</p>
                <a href="{{ route('register') }}">
                    <button
                        class="mt-6 bg-orange-400 text-white text-lg px-8 py-3 rounded-lg shadow-lg hover:bg-orange-500 transition duration-300">Regístrate
                        ahora</button>
                </a>
            </div>
            <div class="w-full md:w-1/2">
                <img src="{{ asset('storage/img/captura-curso.PNG') }}" class="w-full h-auto rounded-lg shadow-lg"
                    alt="Imagen bienvenida">
            </div>
        </div>
    </section>

    <!-- Sección 2: Características del sistema -->
    <section class="py-20 px-6 shadow-lg">
        <h2 class="text-4xl font-bold text-center text-gray-800">Características del Sistema</h2>
        <p class="text-lg text-gray-600 text-center mt-4">Descubre cómo JD-Academy te ayudará a gestionar tus usuarios y
            roles de manera simple y eficiente.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10">
            <div class="bg-white p-8 rounded-lg shadow-lg transition duration-300 hover:scale-105 hover:shadow-xl">
                <h3 class="text-2xl font-semibold text-teal-500">Gestión de Roles</h3>
                <p class="text-gray-600 mt-4">Asigna roles a los usuarios y personaliza sus permisos de acceso con
                    facilidad.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg transition duration-300 hover:scale-105 hover:shadow-xl">
                <h3 class="text-2xl font-semibold text-teal-500">Asignación de Permisos</h3>
                <p class="text-gray-600 mt-4">Define permisos detallados para cada rol y asegúrate de que solo los
                    usuarios autorizados accedan a áreas específicas.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg transition duration-300 hover:scale-105 hover:shadow-xl">
                <h3 class="text-2xl font-semibold text-teal-500">Cursos Gratuitos</h3>
                <p class="text-gray-600 mt-4">Accede a cursos gratuitos que te permitirán comenzar a aprender y dominar
                    las herramientas.</p>
            </div>
        </div>
    </section>

    <!-- Sección 3: Conoce al Desarrollador -->
    <section class="py-20 bg-gray-200 px-6 shadow-lg">
        <h2 class="text-4xl font-bold text-center text-gray-800">Conoce al Desarrollador</h2>
        <div class="max-w-screen-lg mx-auto flex flex-col md:flex-row items-center justify-between mt-10">
            <div class="w-full md:w-1/3 text-center mb-6 md:mb-0">
                <img src="{{ asset('storage/img/developer.jpg') }}" alt="Desarrollador"
                    class="w-32 h-32 rounded-full shadow-lg mx-auto">
                <h3 class="text-xl font-semibold text-gray-800 mt-4">Jordan - Dev</h3>
                <p class="text-lg text-gray-600">Desarrollador Web Junior con experiencia en Laravel, Angular y Tailwind
                    CSS.</p>
            </div>
            <div class="w-full md:w-2/3 text-center md:text-left">
                <p class="text-lg text-gray-600 mt-4">Apasionado por crear soluciones tecnológicas accesibles para
                    todos. Mi objetivo es mejorar la experiencia de usuario mientras enseño a otros a gestionar sus
                    proyectos de forma eficiente.</p>
            </div>
        </div>
    </section>

    <!-- Sección 4: Funcionalidades -->
    <section class="py-20 px-6 shadow-lg">
        <h2 class="text-4xl font-bold text-center text-gray-800">Funcionalidades Destacadas</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10">
            <div class="bg-white p-8 rounded-lg shadow-lg transition duration-300 hover:scale-105 hover:shadow-xl">
                <h3 class="text-2xl font-semibold text-teal-500">Interfaz Intuitiva</h3>
                <p class="text-gray-600 mt-4">Un diseño limpio y fácil de usar para una experiencia eficiente y
                    productiva.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg transition duration-300 hover:scale-105 hover:shadow-xl">
                <h3 class="text-2xl font-semibold text-teal-500">Soporte Continuo</h3>
                <p class="text-gray-600 mt-4">Nuestro equipo está disponible para ayudarte con cualquier duda o problema
                    que tengas.</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg transition duration-300 hover:scale-105 hover:shadow-xl">
                <h3 class="text-2xl font-semibold text-teal-500">Integración con Laravel</h3>
                <p class="text-gray-600 mt-4">Disfruta de una integración perfecta con Laravel para mejorar la gestión
                    de usuarios y permisos en tu aplicación.</p>
            </div>
        </div>
    </section>

    <!-- Sección 5: Contacto -->
    <section id="contact" class="py-20 px-6 bg-gray-200 shadow-lg">
        <h2 class="text-4xl font-bold text-center text-gray-800">Contacto</h2>
        <p class="text-lg text-gray-600 text-center mt-4">¿Tienes alguna pregunta? ¡Estamos aquí para ayudarte!</p>
        <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
            <form action="#" method="POST">
                <input type="text" id="name" name="name" placeholder="Tu nombre"
                    class="w-full p-4 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <input type="email" id="email" name="email" placeholder="Tu correo electrónico"
                    class="w-full p-4 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <textarea id="message" name="message" placeholder="Tu mensaje"
                    class="w-full p-4 mb-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                <button type="submit"
                    class="w-full bg-teal-500 text-white py-3 rounded-lg hover:bg-teal-600 transition duration-300">Enviar
                    mensaje</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-teal-600 text-white py-6">
        <div class="max-w-screen-xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} Jordan-Dev. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>
