<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    /**
     * Constructor para asegurarnos de que el usuario esté autenticado y sea un profesor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra los curso a los Usuarios
     */
    public function index()
    {
        $courses = Course::all(); // Obtener todos los cursos
        return view('index', ['courses' => $courses]);
    }

        /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        // Verificar si el usuario está inscrito en el curso
        $isEnrolled = $user->enrolledCourses->contains($course);

        // Pasamos la información del curso y el estado de inscripción a la vista
        return view('user.show', ['course' => $course, 'isEnrolled' => $isEnrolled]);
    }

    
}
