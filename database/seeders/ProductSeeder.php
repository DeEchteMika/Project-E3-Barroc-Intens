<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Automaten
            [
                'productnummer' => 'S234FREKT',
                'naam' => 'Barroc Intens Italian Light',
                'omschrijving' => "Automaat. Lease contract: €499,- excl. btw per maand. Installatiekosten vast: €289,- excl. btw. Komt met onderhoudscontract. Automatische zendingen van 4kg bonen.",
                'prijs' => 499.00,
                'voorraad' => 0,
                'heeft_maler' => false,
            ],
            [
                'productnummer' => 'S234KNDPF',
                'naam' => 'Barroc Intens Italian',
                'omschrijving' => "Automaat. Lease contract: €599,- excl. btw per maand. Installatiekosten vast: €289,- excl. btw. Komt met onderhoudscontract. Automatische zendingen van 4kg bonen.",
                'prijs' => 599.00,
                'voorraad' => 0,
                'heeft_maler' => false,
            ],
            [
                'productnummer' => 'S234NNBMV',
                'naam' => 'Barroc Intens Italian Deluxe',
                'omschrijving' => "Automaat. Lease contract: €799,- excl. btw per maand. Installatiekosten eenmalig vast: €375,- excl. btw. Heeft ingebouwde bonenmaler. Komt met onderhoudscontract. Automatische zendingen van 4kg bonen.",
                'prijs' => 799.00,
                'voorraad' => 0,
                'heeft_maler' => true,
            ],
            [
                'productnummer' => 'S234MMPLA',
                'naam' => 'Barroc Intens Italian Deluxe Special',
                'omschrijving' => "Automaat. Lease contract: €999,- excl. btw per maand. Installatiekosten eenmalig vast: €375,- excl. btw. Heeft ingebouwde bonenmaler. Komt met onderhoudscontract. Automatische zendingen van 4kg bonen.",
                'prijs' => 999.00,
                'voorraad' => 0,
                'heeft_maler' => true,
            ],

            // Koffiebonen (prijs per kg)
            [
                'productnummer' => 'S239KLIUP',
                'naam' => 'Espresso Beneficio',
                'omschrijving' => "Een toegankelijke en zachte koffie afkomstig van Finca El Limoncillo (Matagalpa, Nicaragua). Beschikbaar als bonen en gemalen.",
                'prijs' => 21.60,
                'voorraad' => 100,
                'heeft_maler' => false,
            ],
            [
                'productnummer' => 'S239MNKLL',
                'naam' => 'Yellow Bourbon Brasil',
                'omschrijving' => "Koffie van de oorspronkelijke koffiestruik (Bourbon) met gele koffiebessen. Zeldzame, prijswinnende koffie. Beschikbaar als bonen en gemalen.",
                'prijs' => 23.20,
                'voorraad' => 100,
                'heeft_maler' => false,
            ],
            [
                'productnummer' => 'S239IPPSD',
                'naam' => 'Espresso Roma',
                'omschrijving' => "Een Italiaanse espresso met een krachtig karakter en een aromatische afdronk. Beschikbaar als bonen en gemalen.",
                'prijs' => 20.80,
                'voorraad' => 100,
                'heeft_maler' => false,
            ],
            [
                'productnummer' => 'S239EVVFS',
                'naam' => 'Red Honey Honduras',
                'omschrijving' => "Honey-methode koffie met extra zoete fruitsmaak. Beschikbaar als bonen en gemalen.",
                'prijs' => 27.80,
                'voorraad' => 100,
                'heeft_maler' => false,
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['productnummer' => $p['productnummer']], $p);
        }
    }
}
