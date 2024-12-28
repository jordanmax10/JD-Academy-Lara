<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Course_Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Mostrar los cursos disponibles.
     */
    public function index()
    {
        $courses = Course::all(); // Obtener todos los cursos disponibles
        return view('user.index', compact('courses'));
    }


    /**
     * Inscribirse en un curso.
     */
    public function enroll(Request $request, Course $course)
    {

        $user = User::find(Auth::id()); // Obtener el usuario autenticado

        // Verificar si el usuario ya está inscrito en el curso
        // contains() es un método de la colección que verifica si un modelo está presente en la colección
        if ($user->enrolledCourses->contains($course)) {
            return back()->with('error', 'Ya estás inscrito en este curso.');
        }


        // Inscribir al usuario en el curso
        Course_Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id, // La columna course_id debe existir en la tabla course__enrollments
            'status' => 'En_proceso',
            'enrolled_at' => now(),
        ]);

        return redirect()->route('user.enrolled')->with('success', 'Te has inscrito al curso exitosamente.');
    }


    /**
     * Mostrar el perfil del usuario.
     */
    public function profile()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('user.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('user.edit', compact('user'));
    }

    /**
     * Actualizar el perfil del usuario.
     */
    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        // Validar los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,avif|max:2048',
        ]);

        // Actualizar los datos del usuario
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Si se proporcionó una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Si se subió una nueva imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($user->url_img && Storage::exists('images/profiles/' . $user->url_img)) {
                Storage::delete('images/profiles/' . $user->url_img);
            }

            // Guardar la nueva imagen
            $imagePath = $request->file('image')->store('images/profiles', 'public');
            $user->url_img = $imagePath; // Actualizar la URL de la imagen en la base de datos
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Perfil Actualizado Correctamente');
    }


    /**
     * Eliminar la cuenta del usuario.
     */
    public function destroyAccount()
    {

        $user = User::find(Auth::id()); // Obtener el usuario autenticado
        $user->delete(); // Eliminar el usuario

        return redirect()->route('home')->with('success', 'Tu cuenta ha sido eliminada exitosamente.');
    }

    /**
     * Mostrar los cursos en los que el usuario está inscrito.
     */
    public function enrolled()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $courses = $user->enrolledCourses; // Obtener los cursos en los que el usuario está inscrito
        return view('user.enrolled_courses', ['courses' => $courses]);
    }

    /**
     * Eliminar la inscripción del usuario a un curso.
     */
    public function cancelEnrollment(Course $course)
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        // Verificar si el usuario está inscrito en el curso
        $enrollment = Course_Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($enrollment) {
            $enrollment->delete(); // Eliminar la inscripción
            return back()->with('success', 'Te has desinscrito del curso exitosamente.');
        }

        return back()->withErrors('error', 'No estás inscrito en este curso.');
    }

    /**
     * Marcar el curso como terminado.
     */
    public function completeCourse(Course $course)
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        // Verificar si el usuario está inscrito en el curso
        $enrollment = Course_Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($enrollment) {
            // Verificar si el estado ya es "terminado"
            if ($enrollment->status == 'terminado') {
                return back()->with('error', 'El curso ya está marcado como terminado.');
            }

            // Cambiar el estado a "terminado"
            $enrollment->status = 'terminado';
            $enrollment->save();

            return back()->with('success', 'Has marcado el curso como terminado.');
        }

        return back()->with('error', 'No estás inscrito en este curso.');
    }
}
