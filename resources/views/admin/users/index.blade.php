@extends('_layouts.app')

@section('title', 'Panel Admin | Usuarios')

@section('content_header_title')
<h1>Lista de Usuarios</h1>
@stop

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin-user.index') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
            </ol>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="container">
    <div class="card">
        <div class="card-header">
            <form action="{{route('admin-user.index')}}" method="GET" class="row">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" name="search" placeholder="Buscar Usuarios" value="{{$search}}" aria-label="Buscar Usuario" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                </div>
            </form>
        </div>

        @if ($users->count())
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead style="color:brown">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td width="10px">
                                <a href="{{route('admin-user.edit',$user->id)}}" class="btn btn-primary btn-sm">Editar</a>
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
            {{$users->links('pagination::bootstrap-5')}}
        </div>
    </div>
</div>

@endsection
