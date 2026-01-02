<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Rediriger selon le rôle de l'utilisateur
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } elseif ($user->role === 'medecin') {
                return redirect()->route('dashboard.medecin');
            } else {
                return redirect()->route('dashboard.patient');
            }
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',  
        'last_name' => 'required|string|max:255',   
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:patient,medecin,admin',  
        'terms' => 'required',  
    ]);

    // Combiner first_name et last_name pour créer le champ name
    $fullName = $validated['first_name'] . ' ' . $validated['last_name'];

    // Créer l'utilisateur
    $user = User::create([
        'name' => $fullName,  // Utilisez le nom complet
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'],
    ]);

    // Connecter automatiquement l'utilisateur après inscription
    Auth::login($user);

    // Rediriger selon le rôle
    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin');
    } elseif ($user->role === 'medecin') {
        return redirect()->route('dashboard.medecin');
    } else {
        return redirect()->route('dashboard.patient');
    }
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('login');
    }
}