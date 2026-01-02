<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROUTE RACINE
|--------------------------------------------------------------------------
|
| Redirection vers la page de login publique
|
*/

Route::get('/', function () {
    return redirect('/login');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

// Affichage du formulaire login (GET)
Route::get('/login', function () {
    return view('Auth.login');
})->name('login');

// Affichage du formulaire register (GET)
Route::get('/register', function () {
    return view('Auth.register');
})->name('register');

// Traitement du formulaire login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Traitement du formulaire register (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARDS protégés par rôle
|--------------------------------------------------------------------------
|
| Les routes sont protégées par middleware : 
| - auth => vérifie la connexion
| - role:<role> => vérifie le rôle exact
|
*/

// Dashboard Médecin
Route::middleware(['auth', 'role:medecin'])->group(function () {
    Route::get('/dashboard/medecin', [DashboardController::class, 'medecin'])
        ->name('dashboard.medecin');
});

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->name('dashboard.admin');
});

// Dashboard Patient
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/dashboard/patient', [DashboardController::class, 'patient'])
        ->name('dashboard.patient');
});



