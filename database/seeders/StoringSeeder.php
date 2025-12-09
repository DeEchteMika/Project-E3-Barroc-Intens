<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Storing;

class StoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storingen = [
            [
                'naam' => 'Server Uitval',
                'beschrijving' => 'De hoofdserver is uitgevallen, wat resulteert in een volledige downtime van de website.',
                'status' => 'Opgelost',
                'locatie' => 'Datacenter Amsterdam',
                'bedrijf' => 'Hosting BV',
                'datum' => '2024-06-15',
                'klant_id' => 1,
                'monteur' => null,
            ],
            [
                'naam' => 'Netwerkproblemen',
                'beschrijving' => 'Er zijn problemen met het interne netwerk, wat leidt tot trage verbindingen.',
                'status' => 'In Behandeling',
                'locatie' => 'Kantoor Rotterdam',
                'bedrijf' => 'Netwerk Solutions',
                'datum' => '2024-06-18',
                'klant_id' => 2,
                'monteur' => 'Jan de Vries',
            ],
            [
                'naam' => 'Software Bug',
                'beschrijving' => 'Een kritieke bug in de software veroorzaakt crashes bij gebruikers.',
                'status' => 'Open',
                'locatie' => 'Kantoor Utrecht',
                'bedrijf' => 'Software Inc.',
                'datum' => '2024-06-20',
                'klant_id' => 3,
                'monteur' => null,
            ],
        ];
        foreach ($storingen as $storing) {
            Storing::updateOrCreate(['naam' => $storing['naam']], $storing);
        }
        Storing::factory()->count(20)->create();
    }
}
