<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;
use App\Models\Klant;
use App\Models\Product;
use Carbon\Carbon;

class ContractSeeder extends Seeder
{
    public function run()
    {
        $klanten = Klant::orderBy('klant_id')->get();
        $producten = Product::orderBy('product_id')->get();

        if ($klanten->isEmpty() || $producten->isEmpty()) {
            return;
        }

        $contracts = [
            [
                'klant_index' => 0,
                'product_index' => 0,
                'contractnummer' => 'C-1001',
                'startdatum' => Carbon::now()->subMonths(3)->toDateString(),
                'einddatum' => Carbon::now()->addMonths(9)->toDateString(),
                'maandbedrag' => 499.00,
                'opmerkingen' => 'Standaard onderhoudscontract',
            ],
            [
                'klant_index' => 1,
                'product_index' => 1,
                'contractnummer' => 'C-1002',
                'startdatum' => Carbon::now()->subMonths(1)->toDateString(),
                'einddatum' => Carbon::now()->addMonths(11)->toDateString(),
                'maandbedrag' => 599.00,
                'opmerkingen' => 'Halfjaarlijks onderhoud',
            ],
            [
                'klant_index' => 2,
                'product_index' => 2,
                'contractnummer' => 'C-1003',
                'startdatum' => Carbon::now()->subMonths(6)->toDateString(),
                'einddatum' => Carbon::now()->addMonths(6)->toDateString(),
                'maandbedrag' => 799.00,
                'opmerkingen' => 'Jaarlijks onderhoud',
            ],
        ];

        foreach ($contracts as $data) {
            $klant = $klanten->get($data['klant_index']);
            $product = $producten->get($data['product_index']);

            if (!$klant || !$product) {
                continue;
            }

            Contract::updateOrCreate(
                ['contractnummer' => $data['contractnummer']],
                [
                    'klant_id' => $klant->klant_id,
                    'product_id' => $product->product_id,
                    'startdatum' => $data['startdatum'],
                    'einddatum' => $data['einddatum'],
                    'maandbedrag' => $data['maandbedrag'],
                    'opmerkingen' => $data['opmerkingen'],
                ]
            );
        }
    }
}
