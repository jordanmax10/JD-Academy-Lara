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
                <div class="col-xl-12">
                    <div class="row">
                        <form action="{{ route('admin-course.index') }}" method="GET">
                            <div class="input-group mb-6">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" name="search" placeholder="Buscar Curso"
                                    value="{{ $search }}" aria-label="Recipient's username"
                                    aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                            </div>
                        </form>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group mb-6">
                                @if (Auth::check() && Auth::user()->can('admin-course.create'))
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="bi bi-plus-circle-fill"></i></span>
                                    <a href="{{ route('admin-course.create') }}" class="btn btn-success">Crear
                                        Nuevo Curso</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            @if ($courses->count())
                <div class="card-body">
                    <table class="table table-striped">
                        <thead style="color:brown">
                            <tr>
                                <td>#</td>
                                <td>Titulo</td>
                                <td>Docente</td>
                                <td>Imagen</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($courses as $index=>$course)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->instructor->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $course->image_url) }}" alt="Imagen del Curso"
                                            style="border-radius: 10px 10px 0 0;" width="120px">
                                    </td>
                                    <td>
                                        @if (Auth::check() && Auth::user()->can('admin-course.edit'))
                                            <a href="{{ route('admin-course.edit', $course->id) }}"
                                                class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i> Editar</a>
                                        @endif
                                        @if (Auth::check() && Auth::user()->can('admin-course.destroy'))
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $course->id }}"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                        @endif
                                    </td>
                                </tr>
                                @include('admin.courses.modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="card-body">
                    <strong>No Hay Registros </strong>
                </div>
            @endif
            <div class="card-footer">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
@endsection
