<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Constructor para asegurarnos de que el usuario esté autenticado y sea un profesor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }
    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = Role::create($request->all());
        if ($role->permissions()->sync($request->permissions)) {
            return redirect()->route('admin-role.edit',$role)->with('success', 'Rol creado con éxito');
        } else {
            return redirect()->route('admin-role.edit',$role)->with('error', 'Error al crear el rol');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', ['role' => $role]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role->update($request->all());
        if ($role->permissions()->sync($request->permissions)) {

            return redirect()->route('admin-role.edit', $role)->with('success', 'Rol actualizado con éxito');
        } else {
            return redirect()->route('admin-role.edit', $role)->with('error', 'Error al actualizar el rol');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->delete()) {
            return redirect()->route('admin-role.index')->with('success', 'Rol eliminado con éxito');
        } else {
            return redirect()->route('admin-role.index')->with('error', 'Error al eliminar el rol');
        }
    }
}
