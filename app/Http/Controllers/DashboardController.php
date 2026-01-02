<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('dashboard.dashboardAdmin');
        }

        abort(403);
    }

    public function medecin()
    {
        $user = Auth::user();

        if ($user->role === 'medecin') {
            return view('dashboard.dashboardMedecin');
        }

        abort(403);
    }

    public function patient()
    {
        $user = Auth::user();

        if ($user->role === 'patient') {
            $reservations = Reservation::with(['service', 'service.medecin'])
                ->where('user_id', $user->id)
                ->orderBy('date_reservation', 'desc')
                ->get();
            
            return view('dashboard.dashboardPatient', compact('reservations'));
        }

        abort(403);
    }
}