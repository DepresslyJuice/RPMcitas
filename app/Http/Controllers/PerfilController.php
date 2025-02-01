<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    /**
     * Mostrar el perfil del usuario actual.
     */
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user(); // Ensure $user is an instance of User model

        // Pasar el usuario a la vista
        return view('perfil.index', compact('user'));
    }

    /**
     * Actualizar el perfil del usuario.
     */
    public function updateProfile(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;

        // Guardar los cambios
        $user->save();

        return redirect()->route('perfil.index')->with('success', 'Perfil actualizado correctamente.');
    }
    public function updatePassword(Request $request)
    {
        // Validación de la contraseña
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('perfil.index')->withErrors(['current_password' => 'La contraseña actual es incorrecta']);
        }

        // Actualizar la contraseña
        $user->password = Hash::make($request->password);

        // Guardar los cambios
        $user->save();

        return redirect()->route('perfil.index')->with('success', 'Contraseña actualizada correctamente.');
    }
}
