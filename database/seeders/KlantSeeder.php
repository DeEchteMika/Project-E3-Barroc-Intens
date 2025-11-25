<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Klant;

class KlantSeeder extends Seeder
{
    public function run()
    {
        $klanten = [
            [
                'klantnummer' => 'K001',
                'bedrijfsnaam' => 'Bedrijf A',
                'contactpersoon' => 'Jan Jansen',
                'adres' => 'Straat 1',
                'postcode' => '1234 AB',
                'plaats' => 'Amsterdam',
                'telefoon' => '0612345678',
                'email' => 'jan.jansen@bedrijfa.nl',
                'bkr_check' => 'Goed gekeurd!',
                'opmerkingen' => '',
            ],
            [
                'klantnummer' => 'K002',
                'bedrijfsnaam' => 'Bedrijf B',
                'contactpersoon' => 'Piet Pietersen',
                'adres' => 'Straat 2',
                'postcode' => '2345 BC',
                'plaats' => 'Rotterdam',
                'telefoon' => '0698765432',
                'email' => 'piet.pietersen@bedrijfb.nl',
                'bkr_check' => 'Nog niet gekeurd...',
                'opmerkingen' => '',
            ],
            [
                'klantnummer' => 'K003',
                'bedrijfsnaam' => 'Bedrijf C',
                'contactpersoon' => 'Klaas Klaassen',
                'adres' => 'Straat 3',
                'postcode' => '3456 CD',
                'plaats' => 'Utrecht',
                'telefoon' => '0687654321',
                'email' => 'klaas.klaassen@bedrijfC.nl',
                'bkr_check' => 'Nog niet gekeurd...',
                'opmerkingen' => '',
            ],
            // Add more klanten if needed
        ];

        foreach ($klanten as $klant) {
            Klant::updateOrCreate(['klantnummer' => $klant['klantnummer']], $klant);
        }
    }
}
