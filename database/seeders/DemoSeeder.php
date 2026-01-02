<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Reservation;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // =======================
        // UTILISATEURS
        // =======================
        User::create([
            'name' => 'Admin',
            'email' => 'admin1@test.com',
            'role' => 'admin',
            'password' => bcrypt('admin123')
        ]);

        $medecin = User::create([
            'name' => 'Dr. Alpha',
            'email' => 'medecin1@test.com',
            'role' => 'medecin',
            'password' => bcrypt('password')
        ]);

        $patient = User::create([
            'name' => 'Patient Beta',
            'email' => 'patient1@test.com',
            'role' => 'patient',
            'password' => bcrypt('password')
        ]);

        // =======================
        // SERVICE
        // =======================
        $service = Service::create([
            'titre' => 'Consultation générale',
            'description' => 'Consultation de base.',
            'prix' => 15000,
            'duree' => 30,
            'date' => now()->addDays(3),
            'statut' => 'actif',
            'medecin_id' => $medecin->id
        ]);

        // =======================
        // RÉSERVATIONS
        // =======================

        // Consultation passée (effectuée)
        Reservation::create([
            'user_id' => $patient->id,
            'service_id' => $service->id,
            'date_reservation' => now()->subDays(5)->format('Y-m-d'),
            'heure_reservation' => '09:00',
            'statut' => 'effectuee', 
            'commentaire' => 'Consultation terminée avec succès.'
        ]);

        // Consultation aujourd'hui (confirmée)
        Reservation::create([
            'user_id' => $patient->id,
            'service_id' => $service->id,
            'date_reservation' => now()->format('Y-m-d'),
            'heure_reservation' => '14:30',
            'statut' => 'confirmee',
            'commentaire' => 'Rendez-vous confirmé pour aujourd\'hui.'
        ]);

        // Consultation future (en attente)
        Reservation::create([
            'user_id' => $patient->id,
            'service_id' => $service->id,
            'date_reservation' => now()->addDays(7)->format('Y-m-d'),
            'heure_reservation' => '11:00',
            'statut' => 'en_attente',
            'commentaire' => 'Rendez-vous en attente de confirmation.'
        ]);

        // Consultation annulée
        Reservation::create([
            'user_id' => $patient->id,
            'service_id' => $service->id,
            'date_reservation' => now()->subDays(2)->format('Y-m-d'),
            'heure_reservation' => '16:00',
            'statut' => 'annulee',
            'commentaire' => 'Rendez-vous annulé par le patient.'
        ]);

        // =======================
        // SECOND MÉDECIN + SERVICE
        // =======================
        $medecin2 = User::create([
            'name' => 'Dr. Beta',
            'email' => 'medecin2@test.com',
            'role' => 'medecin',
            'password' => bcrypt('password')
        ]);

        $service2 = Service::create([
            'titre' => 'Consultation spécialisée',
            'description' => 'Consultation avec un spécialiste.',
            'prix' => 25000,
            'duree' => 45,
            'date' => now()->addDays(5),
            'statut' => 'actif',
            'medecin_id' => $medecin2->id
        ]);

        Reservation::create([
            'user_id' => $patient->id,
            'service_id' => $service2->id,
            'date_reservation' => now()->addDays(10)->format('Y-m-d'),
            'heure_reservation' => '15:00',
            'statut' => 'en_attente',
            'commentaire' => 'Première consultation avec le spécialiste.'
        ]);
    }
}
