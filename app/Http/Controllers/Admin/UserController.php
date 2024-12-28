<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * Constructor para asegurarnos de que el usuario esté autenticado y sea un profesor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin|Teacher');
    }
    
    /**
     * Ver todos los Usuarios
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('search'));
            $users = User::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->paginate(5);
            return view('admin.users.index', ['users' => $users, 'search' => $query]);
        }
    }

    /**
     * Mostrar la vista para editar los roles del Usuarios
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Metodo para actualizar los roles del Usuario
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles); //Registrar los roles en la tabla intermedia

        return redirect()->route('admin-user.edit', $user)->with('success', 'Se asigno los roles Correctamente');
    }
}
