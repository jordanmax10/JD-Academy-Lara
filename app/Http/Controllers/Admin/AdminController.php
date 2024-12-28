<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Course_Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware('role:Admin|Teacher');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener los usuarios registrados
        $users = User::all();

        // Obtener los cursos registrados
        $courses = Course::all();

        // Obtener las inscripciones de los estudiantes
        // Carga las relaciones de usuarios y cursos asociados a las inscripciones
        $enrollments = Course_Enrollment::with('user', 'course')->get();

        // Pasar los datos a la vista
        return view('admin.index', compact('users', 'courses', 'enrollments'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
