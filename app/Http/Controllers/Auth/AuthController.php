<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Manejar la autenticación
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Intentar iniciar sesión
        if (Auth::attempt($credentials)) {
            return redirect()->intended('courses'); // Redirigir a la página principal u otra
        }

        // Si las credenciales no son correctas
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Mostrar el formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Manejar el registro de nuevos usuarios
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // Confirmación de contraseña
            'url_img'=>'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        //Subir imagen
        if($request->hasFile('imagenProfile')){
            $imagePath = $request->file('imagenProfile')->store('images/profiles','public');
        }else{
            $imagePath = null;
        }

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'url_img' => $imagePath,
        ])->assignRole('User');

        // Iniciar sesión automáticamente después del registro
        Auth::login($user);

        // Redirigir al perfil o página principal
        return redirect()->route('courses.index');
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
