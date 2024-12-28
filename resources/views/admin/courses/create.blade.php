@extends('_layouts.app')

@section('title', 'Panel Admin | Cursos')

@section('content_header_title')
    <h1>Crear Nuevo Curso</h1>
@stop

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a  href="{{route('admin-course.index')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Cursos</li>
                </ol>
        </div>
    </div>
</div>

    <form action="{{ route('admin-course.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Título del curso</label>
            <input type="text" name="title" class="form-control" id="title" required>
            @error('title')
                <div class="text-red">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descripción del curso</label>
            <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
            @error('description')
                <div class="text-red">
                    {{$message}}
                </div>
            @enderror
        </div>
        <br>
        <div class="form-group">
            <label for="image">Imagen del curso</label>
            <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
            @error('image')
                <div class="text-red">
                    {{$message}}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Crear curso</button>
    </form>
@endsection
