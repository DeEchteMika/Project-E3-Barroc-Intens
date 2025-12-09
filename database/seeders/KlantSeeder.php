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
                'opmerkingen' => 'interessante klant',
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
                'opmerkingen' => 'mooie klant',
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
                'opmerkingen' => 'belangrijke klant',
            ],
            [
                'klantnummer' => 'K004',
                'bedrijfsnaam' => 'Bedrijf D',
                'contactpersoon' => 'Marie de Vries',
                'adres' => 'Straat 4',
                'postcode' => '4567 DE',
                'plaats' => 'Eindhoven',
                'telefoon' => '0676543210',
                'email' => 'marie.devries@bedrijfD.nl',
                'bkr_check' => 'Nog niet gekeurd...',
                'opmerkingen' => 'prachtige klant',
            ],
            [
                'klantnummer' => 'K005',
                'bedrijfsnaam' => 'Bedrijf E',
                'contactpersoon' => 'Hans van den Berg',
                'adres' => 'Straat 5',
                'postcode' => '5678 EF',
                'plaats' => 'Groningen',
                'telefoon' => '0665432109',
                'email' => 'hans.vandenberg@bedrijfE.nl',
                'bkr_check' => 'Afgekeurd!',
                'opmerkingen' => 'lastige klant',
            ],
            // Add more klanten if needed
        ];

        foreach ($klanten as $klant) {
            Klant::updateOrCreate(['klantnummer' => $klant['klantnummer']], $klant);
        }
    }
}
