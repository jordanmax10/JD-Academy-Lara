<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Teacher']);
        $role3 = Role::create(['name' => 'User']);


        //Admin, Profe, User
        Permission::create([
            'name' => 'courses.index',
            'description' => 'Permite ver el listado de cursos fuera del dashboard'
        ])->syncRoles([$role1, $role2, $role3]); //User Autenticado
        
        //Profe y Admin
        Permission::create([
            'name' => 'dashboard',
            'description' => 'Permite ver el dashboard'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin-courses.index',
            'description' => 'Permite ver el listado de cursos'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin-course.create',
            'description' => 'Permite ver el formulario de creación de cursos'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin-course.edit',
            'description' => 'Permite ver el formulario de edición de cursos'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin-course.destroy',
            'description' => 'Permite eliminar cursos'
        ])->syncRoles([$role1, $role2]);
        
        Permission::create([
            'name' => 'admin-course.edit.teacher',
            'description' => 'Permite ver el formulario de edición de profesores'
        ])->syncRoles([$role1]); //Solo el Admin        

        //Permisos del Admin en Usuarios 
        Permission::create([
            'name' => 'admin-user.index',
            'description' => 'Permite ver el listado de usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin-user.edit',
            'description' => 'Permite ver el formulario de edición de usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin-user.update',
            'description' => 'Permite actualizar usuarios'
        ])->syncRoles([$role1]);

        
        //Permisos del Admin en Roles
        Permission::create([
            'name' => 'admin-role.index',
            'description' => 'Permite ver el listado de roles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin-role.create',
            'description' => 'Permite ver el formulario de creación de roles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin-role.edit',
            'description' => 'Permite ver el formulario de edición de roles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin-role.destroy',
            'description' => 'Permite eliminar roles'
        ])->syncRoles([$role1]);


        

        //User
        Permission::create([
            'name' => 'user.profile',
            'description' => 'Permite ver el perfil de usuario'
        ])->syncRoles([$role3]);
        Permission::create([
            'name' => 'user.profile.edit',
            'description' => 'Permite ver el formulario de edición de perfil'
        ])->syncRoles([$role3]);
        Permission::create([
            'name' => 'user.profile.update',
            'description' => 'Permite actualizar el perfil de usuario'
        ])->syncRoles([$role3]);
        Permission::create([
            'name' => 'user.destroy',
            'description' => 'Permite eliminar la cuenta de usuario'
        ])->syncRoles([$role3]);
        Permission::create([
            'name' => 'user.enrolled',
            'description' => 'Permite ver los cursos en los que está inscrito el usuario'
        ])->syncRoles([$role1, $role2, $role3]);
        Permission::create([
            'name' => 'user.enroll',
            'description' => 'Permite inscribirse a un curso'
        ])->syncRoles([$role3]);
        Permission::create([
            'name' => 'user.unenrolled',
            'description' => 'Permite desinscribirse de un curso'
        ])->syncRoles([$role3]);
    }
}
