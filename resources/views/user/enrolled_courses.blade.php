@extends('_layouts.user')

@section('content')

    <h1 class="text-2xl font-extrabold text-center text-gray-900 dark:text-white mb-6
    md:text-3xl">Mis Cursos <span
            class="text-orange-500">Inscritos</span></h1>

    @if ($courses->isEmpty())
        <p class="text-2xl font-extrabold text-center mt-10 text-gray-900 dark:text-white mb-6
    md:text-3xl md:mt-10">No
            estás inscrito en ningún curso.</p>
    @else
        <div class="flex gap-5 m-5 items-center flex-col md:flex-row">
            @foreach ($courses as $course)
                <div
                    class="w-80 bg-gray-300 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700
                 md:w-80 md:max-h-full">
                    @if ($course->image_url)
                        <img src="{{ asset('storage/' . $course->image_url) }}"
                            class="card-img-top h-24 w-full object-cover md:w-full md:h-40" alt="Imagen del curso"
                            style="border-radius: 10px 10px 0 0;">
                    @else
                        <img src="{{ asset('storage/courses/default.jpg') }}" class="card-img-top" alt="Imagen del curso"
                            style="border-radius: 10px 10px 0 0;">
                    @endif
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $course->title }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $course->description }}</p>
                        <p><strong>Profesor:</strong>
                            @if ($course->instructor)
                                {{ $course->instructor->name }}
                            @else
                                No asignado
                            @endif
                        </p>
                        <div class="flex justify-center mt-2">
                            @if (Auth::check())
                                @if (Auth::user()->enrolledCourses->contains($course))
                                    <a class="text-gray-900 bg-gradient-to-r from-green-200 via-green-400 to-green-500  focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                                        href="{{ route('courses.show', $course->id) }}">Ir al Curso</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="font-medium">Inicia sesión para
                                    inscribirte</a>
                            @endif

                            <form action="{{ route('user.unenroll', $course) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de eliminar este curso?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Eliminar
                                    Curso</button>
                            </form>
                        </div>


                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
