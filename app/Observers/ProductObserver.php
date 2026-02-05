<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Inkoop;
use App\Models\InkoopRegel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function updated(Product $product)
    {
        $threshold = config('inkoop.threshold', 20);
        $restockAmount = config('inkoop.restock_amount', 20);

        // Alleen bijbestellen als voorraad onder drempel en nog geen recente bestelling
        if ($product->voorraad < $threshold) {
            $medewerkerId = optional(Auth::user())->medewerker ? Auth::user()->medewerker->medewerker_id : null;
            $prijsPerStuk = $product->prijs ?? 0;
            $subtotaal = $prijsPerStuk * $restockAmount;

            $inkoop = Inkoop::create([
                'medewerker_id' => $medewerkerId,
                'datum' => Carbon::now()->format('Y-m-d H:i:s'),
                'totaalbedrag' => $subtotaal,
                'opmerking' => 'Automatisch bijbesteld (voorraad onder ' . $threshold . ')',
            ]);

            InkoopRegel::create([
                'inkoop_id' => $inkoop->inkoop_id,
                'product_id' => $product->product_id,
                'aantal' => $restockAmount,
                'prijs_per_stuk' => $prijsPerStuk,
                'subtotaal' => $subtotaal,
            ]);

            $product->increment('voorraad', $restockAmount);
        }
    }
}
