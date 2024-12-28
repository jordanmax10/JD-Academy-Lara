@extends('_layouts.app')


@section('title', 'Panel Admin | Cursos')

@section('content_header_title')
    <h1>Editar el Curso : {{ $course->title }}</h1>
@stop


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin-course.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Cursos</li>
                </ol>
            </div>
        </div>
    </div>

    <form action="{{ route('admin-course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titulo</label>
            <input type="text" class="form-control" name="title" id="title"
                placeholder="Ingrese el Nombre del Curso" value="{{ $course->title }}" required>
            @error('title')
                <div class="text-red">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Descripcion</label>
            <input type="text" class="form-control" name="description" id="description"
                placeholder="Ingrese la Descripcion del Curso" value="{{ $course->description }}" required>
            @error('description')
                <div class="text-red">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @if (Auth::check() && Auth::user()->can('admin-course.edit.teacher'))
            <div class="form-group">
                <label for="teacher_id">Instructor</label>
                <select name="teacher_id" id="teacher_id" class="form-control" required>
                    <option value="">--Seleccione--</option>
                    @foreach ($profe as $pro)
                        <option value="{{ $pro->id }}" @if ($course->teacher_id === $pro->id) selected @endif>
                            {{ $pro->name }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="form-group">
                <Label for="teacher_id">Instructor/Docente</Label>
                <label class="form-control" for="teacher_id">{{ Auth::user()->name }}</label>
            </div>
        @endif

        <div class="form-group">
            <label for="image">Imagen</label>

            @if ($course->image_url)
                <img src="{{ asset('storage/' . $course->image_url) }}" width="200px" alt="Imagen del curso"
                    style="border-radius: 10px 10px 0 0;">
                <small>Si no deseas cambiar la imagen, deja el campo vacío.</small>
                <input type="file" class="form-control" name="image" id="image">
            @else
                <input type="file" class="form-control" name="image" id="image" required>
            @endif
            @error('image')
                <div class="text-red">
                    {{$message}}
                </div>
            @enderror
        </div><br>
        <div>
            <button type="submit" class="btn btn-warning">Registrar</button>
        </div>
    </form>
@endsection
