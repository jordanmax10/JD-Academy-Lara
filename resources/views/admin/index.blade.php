@extends('_layouts.app')

@section('title', 'Panel Admin | Dashboard')

@section('content_header_title')
    Panel Admin
@section('content_header_subtitle')
    Dashboard
@stop
@stop

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Bienvenidos al Dashboard</h1>

    <div class="row mb-4">
        <!-- Usuarios Registrados -->
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-person-fill" style="font-size: 3rem; color: #17a2b8;"></i>
                    <h3 class="card-title mt-3">Usuarios Registrados</h3>
                    <p class="card-text" style="font-size: 2rem;">{{ $users->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Cursos Registrados -->
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-book-fill" style="font-size: 3rem; color: #28a745;"></i>
                    <h3 class="card-title mt-3">Cursos Registrados</h3>
                    <p class="card-text" style="font-size: 2rem;">{{ $courses->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Estudiantes Inscritos -->
        <div class="col-md-4 col-sm-12 mb-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-person-check-fill" style="font-size: 3rem; color: #ffc107;"></i>
                    <h3 class="card-title mt-3">Estudiantes Inscritos</h3>
                    <p class="card-text" style="font-size: 2rem;">{{ $enrollments->count() }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
