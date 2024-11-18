@extends('_layouts.app')

@section('title', 'Panel Admin | Usuarios')

@section('content_header_title')
    <h1>Asignar Rol</h1>
@stop

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <p class="h5">Nombre:</p>
                <strong class="form-control">{{ $user->name }} </strong>
            </div>

            <div class="card-footer">
                <h2 class="h5">Lista de Roles</h2>
                <div class="form">
                    <form action="{{ route('admin-user.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @foreach ($roles as $role)
                            <label>
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="mr-1"
                                    {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                                {{ $role->name }}
                            </label><br>
                        @endforeach
                        <hr>
                        <button type="submit" class="btn btn-success">Asignar Rol</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
