<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin|Teacher');
    }

    /**
     * Ver Vista del Perfil
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        // Validar los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',  // Removido avif y gif
        ]);

        try {
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
                $imagePath = $request->file('image')->store('images/profiles/', 'public');
                $user->url_img = $imagePath; // Actualizar la URL de la imagen en la base de datos
            }

            $user->save();

            return redirect()->route('admin-profile.index')
                ->with('success', 'Perfil actualizado correctamente.');
        } catch (QueryException $e) {
            // Capturar errores de base de datos (como conflictos de clave única)
            return redirect()->back()
                ->with('error', 'Hubo un error al actualizar el perfil. Por favor, inténtalo de nuevo.');
        } catch (\Exception $e) {
            // Capturar cualquier otro tipo de error no previsto
            return redirect()->back()
                ->with('error', 'Ocurrió un error inesperado. Por favor, intenta nuevamente más tarde.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        try {
            $user = User::find(Auth::id());

            // Eliminar el usuario
            $user->delete();

            // Redirigir con mensaje de éxito
            return redirect()->route('home')
                ->with('success', 'Tu cuenta ha sido eliminada exitosamente.');
        } catch (QueryException $e) {
            // Capturar errores de base de datos (como problemas al eliminar el usuario)
            return redirect()->route('home')
                ->with('error', 'Hubo un error al eliminar tu cuenta. Por favor, inténtalo de nuevo.');
        } catch (\Exception $e) {
            // Capturar cualquier otro tipo de error no previsto
            return redirect()->route('home')
                ->with('error', 'Ocurrió un error inesperado. Por favor, intenta nuevamente más tarde.');
        }
    }
}
