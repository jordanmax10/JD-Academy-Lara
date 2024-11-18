@extends('_layouts.app')

@section('title', 'Panel Admin | Usuarios')

@section('content_header_title')
<h1>Lista de Usuarios</h1>
@stop

@section('content')
<div class="container">
    <div class="card">

        <div class="card-header">
           <form action="{{route('admin-user.index')}}" method="GET">
            <div class="input-group mb-6">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" name="search" placeholder="Buscar Usuarios" value="{{$search}}" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
            </div>
           </form>
        </div>
        @if ($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead style="color:brown">
                    <tr>
                        <td>#</td>
                        <td>Nombre</td>
                        <td>Correo Electronico</td>
                        <td>Acciones</td>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td width="10px">
                            <a href="{{route('admin-user.edit',$user->id)}}" class="btn btn-primary">Editar</a>
                        </td>
                    </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
        @else
        <div class="card-body">
            <strong>No Hay Registros </strong>
        </div>
        @endif
        <div class="card-footer">
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection
