@extends('_layouts.user')

@section('content')
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Imagen del curso (opcional) -->
                <div class="md:w-1/3">
                    <img src="{{ asset('storage/' . $course->image_url) }}" alt="Imagen del curso"
                        class="w-full h-full object-cover rounded-lg md:rounded-none md:mr-6">
                </div>
                <!-- Información del curso -->
                <div class="md:w-2/3 p-6">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $course->title }}</h2>
                    <p class="mt-2 text-lg text-gray-600"><strong>Categoría:</strong> {{ $course->description }}</p>
                    {{-- <p class="mt-2 text-lg text-gray-600"><strong>Estado:</strong> {{ $course->students->status }}</p> --}}
                    <p class="mt-2 text-lg text-gray-600"><strong>Profesor:</strong>
                        @if ($course->instructor)
                            {{ $course->instructor->name }}
                        @else
                            No asignado
                        @endif
                    </p>

                    <!-- Acción de inscripción -->
                    <div class="mt-6 flex justify-between gap-5">
                        @if (Auth::check())
                            @if (Auth::user()->hasRole('User'))
                                @if (!$isEnrolled)
                                    <form action="{{ route('user.enroll', $course) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-teal-500 text-white py-3 px-6 rounded-lg hover:bg-teal-600 focus:outline-none transition duration-200">
                                            Inscribirse
                                        </button>
                                    </form>
                                @else
                                    <button class="w-full bg-green-500 text-white py-3 px-6 rounded-lg cursor-not-allowed"
                                        disabled>
                                        Ya estás inscrito
                                    </button>
                                    <button
                                        class="w-full bg-orange-500 text-white py-3 px-6 rounded-lg hover:bg-orange-600">
                                        Terminar Curso
                                    </button>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full bg-blue-500 text-white py-3 px-6 rounded-lg text-center hover:bg-blue-600 focus:outline-none transition duration-200">
                                Inicia sesión para inscribirte
                            </a>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
