<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\courseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('search'));
            $courses = Course::where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')
                ->paginate(10);

            // Añadir el número de estudiantes inscritos en cada curso
            foreach ($courses as $course) {
                $course->student_count = $course->students()->count();
            }

            return view('admin.courses.index', ['courses' => $courses, 'search' => $query]);
        }
    }

    /**
     * GetStudents: Obtiene la lista de estudiantes inscritos en un curso.
     * retorna la lista de estudiantes en formato JSON.
     */

    public function getStudents($courseId)
    {
        // Obtén el curso por su ID
        $course = Course::findOrFail($courseId);

        // Obtén los estudiantes inscritos en el curso
        $students = $course->students()->get();  // Esto obtiene los usuarios relacionados con el curso

        // Retorna la lista de estudiantes en formato JSON
        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profe = Auth::user(); // Obtener el usuario autenticado (profesor)
        return view('admin.courses.create', ['profe' => $profe]); // Pasamos la información del profesor a la vista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(courseRequest $request)
    {
        // Subir la imagen, si es proporcionada
        if ($request->hasFile('image')) {
            // Subir la imagen y obtener la ruta
            $imagePath = $request->file('image')->store('images/courses', 'public');
        } else {
            $imagePath = null; // Si no se proporciona una imagen, dejamos el valor como nulo
        }

        // Crear el curso y guardar los datos
        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => auth()->id(), // Profesor autenticado
            'image_url' => $imagePath, // Guardar la ruta de la imagen
        ]);

        return redirect()->route('admin-course.index')->with('success', 'Curso Creado Correctamente');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $profe = User::all(); // Obtener todos los profesores (para elegir otro profesor si se necesita)
        return view('admin.courses.edit', ['course' => $course, 'profe' => $profe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(courseRequest $request, Course $course)
    {

        $request->validated();

        // Subir la imagen, si es proporcionada
        if ($request->hasFile('image')) {
            // Subir la imagen y obtener la ruta
            $imagePath = $request->file('image')->store('images/courses', 'public');
        } else {
            $imagePath = $course->image_url; // Si no se proporciona una imagen, dejamos el valor como nulo
        }

        // Si el usuario es Admin
        if (Gate::allows('admin-course.edit.teacher') && $request->has('teacher_id')) {
            $teacherId = $request->teacher_id;
        } else {
            $teacherId = auth()->id();
        }

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => $teacherId,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin-course.index')->with('success', 'Curso Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete(); // Eliminar el curso

        return redirect()->route('admin-course.index')->with('success', 'Curso Eliminado Correctamente'); // Redirigir al listado de cursos
    }

    // public function storeFile(Request $request, $courseId)
    // {
    //     // Validación del archivo
    //     $request->validate([
    //         'file' => 'required|file|mimes:pdf,docx,zip|max:10240', // Validación: máximo 10MB y solo ciertos tipos de archivos
    //     ]);

    //     // Obtener el archivo subido
    //     $file = $request->file('file');

    //     // Subir el archivo y obtener la ruta
    //     $filePath = $file->store('course_files', 'public');

    //     // Obtener el curso
    //     $course = Course::findOrFail($courseId);

    //     // Guardar el archivo en la base de datos
    //     $course->files()->create([
    //         'file_url' => $filePath,  // Ruta del archivo
    //         'file_name' => $file->getClientOriginalName(), // Nombre original del archivo
    //     ]);

    //     return back()->with('success', 'Archivo adicional subido exitosamente');
    // }
}
