<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Correction: remplacer 'which' par 'with'
        $services = Service::where('statut', 'actif')->with('medecin')->get();
        return view('dashboard.dashboardPatient', compact('services'));
    }

    public function show($id)
    {
        $service = Service::with('medecin')->findOrFail($id);
        return view('services.show', compact('service'));
    }
}