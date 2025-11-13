<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medewerker;
use App\Models\Rechten;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MedewerkerSeeder extends Seeder
{
    public function run()
    {
        // Create one example user per role (minimal data)
        $roles = Rechten::all();

        if ($roles->isEmpty()) {
            $this->call(RechtenSeeder::class);
            $roles = Rechten::all();
        }

        foreach ($roles as $role) {
            $medewerker = Medewerker::create([
                'voornaam' => ucfirst($role->rol),
                'achternaam' => 'User',
                'functie' => $role->rol,
                'afdeling_id' => null,
                'email' => $role->rol . '@example.com',
                'telefoon' => null,
                'rechten_id' => $role->rechten_id,
                'actief' => true,
            ]);

            // Create a corresponding auth User so the medewerker can log in
            $user = User::create([
                'name' => $medewerker->voornaam . ' ' . $medewerker->achternaam,
                'email' => $medewerker->email,
                'password' => Hash::make('password'),
            ]);

            $medewerker->user_id = $user->id;
            $medewerker->save();
        }
    }
}
