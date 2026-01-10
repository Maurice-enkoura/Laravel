<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return view('dashboard.admin');
        }
        if ($user->role === 'medecin') {
            return view('dashboard.medecin');
        }
        return view('dashboard.patient');
    }


}
