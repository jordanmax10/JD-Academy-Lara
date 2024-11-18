@forelse ($courses as $course)
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
            {{-- <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $course->description }}</p> --}}
            <p><strong>Profesor:</strong>
                @if ($course->instructor)
                    {{ $course->instructor->name }}
                @else
                    No asignado
                @endif
            </p>

            <div class="flex mt-2 justify-center">
                @if (Auth::check())
                    @if (Auth::user()->hasRole('User'))
                        @if (!Auth::user()->enrolledCourses->contains($course))
                            <form action="{{ route('user.enroll', $course) }}" method="POST"
                                onsubmit="return confirm('Seguro de Inscribirse en este Curso?')">
                                @csrf
                                <button type="submit"
                                    class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Inscribirse</button>
                            </form>
                        @elseif (Auth::user()->enrolledCourses->contains($course))
                            <button
                                class="text-gray-900 bg-gradient-to-r from-yellow-200 via-yellow-400 to-yellow-500  focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-yellow-800 shadow-lg shadow-yellow-500/50 dark:shadow-lg dark:shadow-yellow-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 "
                                disabled>Ya estás inscrito</button>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" class="font-medium">Inicia sesión para
                        inscribirte</a>
                @endif
                <a href="{{ route('courses.show', $course->id) }}"
                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Ver
                    Curso</a>
            </div>
        </div>
    </div>

@empty
    <p>NO HAY CURSOS</p>


@endforelse
