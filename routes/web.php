<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MedecinController;

/*
|--------------------------------------------------------------------------
| ROUTE RACINE
|--------------------------------------------------------------------------
|
| Redirection vers la page de login publique
Route::get('/', function () {
    return redirect('/login');
})->name('home');
|
*/
Route::get('/', function () {
    return view('accueil.index');
})->name('home');

/*
Route::get('/', function () {
    return redirect('/login');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

Route::prefix('test')->group(function () { 

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

// OPTION 1 : Routes séparées avec des noms corrects
/*

*/


Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/dashboard/patient', function () {
        return view('dashboard.patient');
    })->name('dashboard.patient');
});

Route::middleware(['auth', 'role:medecin'])->group(function () {
    Route::get('/dashboard/medecin', function () {
        return view('dashboard.medecin');
    })->name('dashboard.medecin');
    Route::get('/medecin/reservations', [MedecinController::class, 'reservations'])
        ->name('medecin.reservations');
    Route::get('/medecin/services', [MedecinController::class, 'services'])
        ->name('medecin.services');
    Route::patch('/medecin/reservations/{id}/status', [MedecinController::class, 'updateStatus'])
        ->name('medecin.reservations.update-status');
        

        Route::get('/medecin/reservations/create', [MedecinController::class, 'createService'])
        ->name('medecin.reservations.create');
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard admin ;j'ai pas utiliser les controller pour ces routes car pas de logique pour l'instant

    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->name('dashboard.admin');

    Route::get('/admin/users', function () {
        return view('admin.users.index');
    })->name('admin.users');


    Route::get('/admin/reservations', function () {
        return view('admin.reservations.index');
    })->name('admin.reservations');

    Route::get('/admin/reports', function () {
        return view('admin.reports.index');
    })->name('admin.reports');
});
Route::get('/admin/services/create', function () {
    return view('admin.services.create');
})->name('admin.services.create');

/*
Route::post('/services', [ServiceController::class, 'store'])
    ->name('services.store');
    */
Route::get('/admin/services', function () {
    return view('admin.services');
})->name('admin.services');

/*
|--------------------------------------------------------------------------
| SERVICES (publiques)
|--------------------------------------------------------------------------
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
*/

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');




/*
|--------------------------------------------------------------------------
| RÉSERVATIONS (protégées par auth)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:patient'])->group(function () {
    // Créer une réservation
    Route::get('/reservations/create/{service_id}', [ReservationController::class, 'create'])
        ->name('reservations.create');

    Route::post('/reservations', [ReservationController::class, 'store'])
        ->name('reservations.store');

    // Mes réservations (pour patients)
    Route::get('/mes-reservations', [ReservationController::class, 'myReservations'])
        ->name('reservations.my');

    // Annuler une réservation
    Route::patch('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])
        ->name('reservations.cancel');
});
}); 
