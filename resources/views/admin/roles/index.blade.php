@extends('_layouts.app')

@section('title', 'Panel Admin | Roles')

@section('content_header_title')
    <h1>Lista de Roles</h1>
@stop

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin-role.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container">
        <div class="card">
            @if (Auth::user()->can('admin-course.create'))
                <div class="card-header">
                    <div class="input-group mb-3">
                        <a href="{{ route('admin-role.create') }}" class="btn btn-success w-100">Nuevo Rol</a>
                    </div>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Rol</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $index=>$role)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    @if (Auth::user()->can('admin-course.edit'))
                                    <td width="10px">
                                        <a href="{{ route('admin-role.edit', $role) }}" class="btn btn-primary btn-sm">Editar</a>
                                    </td>
                                    @endif
                                    @if (Auth::user()->can('admin-course.destroy'))
                                        <td width="10px">
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-delete-{{ $role->id }}"><i class="fas fa-trash-alt"></i>
                                                Eliminar</button>
                                        </td>
                                    @endif
                                </tr>
                                @include('admin.roles.modal')
                            @empty
                                <tr>
                                    <td colspan="3">No hay roles registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
