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

        // Verificar si el usuario está inscrito en el curso utilizando enrolledCourses
        $isEnrolled = $user->enrolledCourses->contains($course);

        // Si está inscrito, obtenemos el estado de la inscripción usando la relación students()
        $enrollmentStatus = null;
        if ($isEnrolled) {
            // Obtener la inscripción en la tabla pivot para el usuario y el curso
            $enrollment = $course->students()->where('user_id', $user->id)->first();
            $enrollmentStatus = $enrollment ? $enrollment->pivot->status : null;
        }

        // Pasamos la información del curso, el estado de inscripción y si está inscrito a la vista
        return view('user.show', [
            'course' => $course,
            'isEnrolled' => $isEnrolled,
            'enrollmentStatus' => $enrollmentStatus,
        ]);
    }
}
