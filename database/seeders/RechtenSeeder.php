<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rechten;

class RechtenSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['rol' => 'admin', 'toegangsniveau' => 10, 'beschrijving' => 'Administrator met volledige toegang'],
            ['rol' => 'sales', 'toegangsniveau' => 5, 'beschrijving' => 'Sales team'],
            ['rol' => 'financien', 'toegangsniveau' => 6, 'beschrijving' => 'Financiële afdeling'],
            ['rol' => 'onderhoud', 'toegangsniveau' => 4, 'beschrijving' => 'Onderhoudsmonteurs'],
            ['rol' => 'inkoop', 'toegangsniveau' => 4, 'beschrijving' => 'Inkoop medewerkers'],
            ['rol' => 'klantenservice', 'toegangsniveau' => 3, 'beschrijving' => 'Klantenservice medewerkers'],
            ['rol' => 'management', 'toegangsniveau' => 8, 'beschrijving' => 'Management level'],
        ];

        foreach ($roles as $role) {
            Rechten::updateOrCreate(['rol' => $role['rol']], $role);
        }
    }
}
