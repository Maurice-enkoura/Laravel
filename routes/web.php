<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function() {
    return view('dashboard.dashboardAdmin'); 
})->name('home');


*/


Route::get('/', function() {
    return view('dashboard.dashboardPatient');
})->name('dashboard.patient');

Route::get('/dashboard-medecin', function() {
    return view('dashboard.dashboardMedecin');
})->name('dashboard.medecin');

Route::get('/dashboard-admin', function() {
    return view('dashboard.dashboardAdmin');
})->name('dashboard.admin');


Route::get('/Auth-login', function() {
    return view('Auth.login');
})->name('login.html');

Route::get('/Auth-register', function() {
    return view('Auth.register');
})->name('register.html');


