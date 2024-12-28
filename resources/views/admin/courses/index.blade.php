@extends('_layouts.app')

@section('title', 'Panel Admin | Cursos')

@section('content_header_title')
    <h1>Lista de Cursos Creados</h1>
@stop

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin-course.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Cursos</li>
                </ol>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <form action="{{ route('admin-course.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" name="search" placeholder="Buscar Curso"
                                    value="{{ $search }}" aria-label="Buscar Curso"
                                    aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        @if (Auth::check() && Auth::user()->can('admin-course.create'))
                            <div class="input-group mb-3">
                                <a href="{{ route('admin-course.create') }}" class="btn btn-success w-100">Crear Nuevo Curso</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if ($courses->count())
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead style="color:brown">
                                <tr>
                                    <th>#</th>
                                    <th>Titulo</th>
                                    <th>Docente</th>
                                    <th>Imagen</th>
                                    <th>Estudiantes Inscritos</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($courses as $index => $course)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ $course->instructor->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $course->image_url) }}" alt="Imagen del Curso"
                                                style="border-radius: 10px 10px 0 0;" width="120px">
                                        </td>
                                        <td>{{ $course->students()->count() }}</td> <!-- Mostrar la cantidad de estudiantes -->
                                        <td>
                                            @if (Auth::check() && Auth::user()->can('admin-course.edit'))
                                                <a href="{{ route('admin-course.edit', $course->id) }}"
                                                    class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i> Editar</a>
                                            @endif
                                            @if (Auth::check() && Auth::user()->can('admin-course.destroy'))
                                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $course->id }}"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                            @endif
                                            <!-- Botón para ver estudiantes -->
                                            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#studentsModal" onclick="loadStudents({{ $course->id }})"><i class="fas fa-users"></i> Ver Estudiantes</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <strong>No Hay Registros</strong>
                </div>
            @endif

            <div class="card-footer">
                {{ $courses->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>

    <!-- Modal para ver estudiantes inscritos -->
    <div class="modal fade" id="studentsModal" tabindex="-1" role="dialog" aria-labelledby="studentsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentsModalLabel">Estudiantes Inscritos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="studentsList">
                        <!-- Aquí se mostrarán los estudiantes -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function loadStudents(courseId) {
            // Hacer una solicitud AJAX para obtener los estudiantes inscritos en el curso
            $.ajax({
                url: '/admin/courses/' + courseId + '/students', // Llamada al método en el controlador
                method: 'GET',
                success: function(response) {
                    let studentsList = $('#studentsList');
                    studentsList.empty(); // Limpiar la lista de estudiantes

                    response.forEach(function(student) {
                        studentsList.append('<li>' + student.name + ' (' + student.email + ')</li>');
                    });
                },
                error: function() {
                    alert('Error al cargar los estudiantes');
                }
            });
        }
    </script>
@endsection
