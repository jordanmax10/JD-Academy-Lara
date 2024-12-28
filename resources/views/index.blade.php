@extends('_layouts.user')

@section('content')
    <h1 class="text-2xl font-extrabold text-center text-gray-900 dark:text-white mb-6
    md:text-3xl">Nuestros Cursos <span
            class="text-orange-500">Para Tí</span></h1>

    <div class="flex gap-5 m-5 items-center flex-col md:flex-row">
        @include('_includes.cardCourse')
    </div>
@endsection
