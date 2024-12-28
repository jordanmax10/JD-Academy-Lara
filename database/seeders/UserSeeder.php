<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Max Dev',
            'email'=>'admin@gmail.com',
            'password'=> bcrypt('admin123'),
            'url_img'=>''
        ])->assignRole('Admin');

        User::create([
            'name'=>'Prueba User',
            'email'=>'prueba@gmail.com',
            'password'=> bcrypt('prueba123'),
            'url_img'=>''
        ])->assignRole('User');

        User::create([
            'name'=>'Ing.Marcos Lopez',
            'email'=>'profe@gmail.com',
            'password'=> bcrypt('profe123'),
            'url_img'=>''
        ])->assignRole('Teacher');

        
    }
}
