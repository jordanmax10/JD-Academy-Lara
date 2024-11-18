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
        $role1= Role::create(['name'=>'Admin']);
        $role2= Role::create(['name'=>'Teacher']);
        $role3= Role::create(['name'=>'User']);

        
        //Profe y Admin
        Permission::create(['name'=>'dashboard'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin-courses.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin-course.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin-course.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin-course.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin-course.edit.teacher'])->syncRoles([$role1]); //Solo Admin
        
        //Permisos del Admin en Usuarios y Profe
        Permission::create(['name'=>'admin-user.index'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin-user.edit'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin-user.update'])->syncRoles([$role1]);

        
        //Admin, Profe, User
        Permission::create(['name'=>'courses.index'])->syncRoles([$role1,$role2,$role3]); //User Autenticado

        //User
        Permission::create(['name'=>'user.profile'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'user.profile.edit'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'user.profile.update'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'user.destroy'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'user.enrolled'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'user.enroll'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name'=>'user.unenrolled'])->syncRoles([$role1,$role2,$role3]);
    }
}
