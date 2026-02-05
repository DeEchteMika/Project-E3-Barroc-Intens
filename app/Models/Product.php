<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inkoop;
use App\Models\InkoopRegel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $timestamps = true;

    protected $fillable = [
        'productnummer',
        'naam',
        'omschrijving',
        'prijs',
        'voorraad',
        'heeft_maler',
    ];

    public function contracts(){
        return $this->belongsToMany(Contract::class, 'contract_product', 'product_id', 'contract_id')
            ->withPivot('aantal')
            ->withTimestamps();
    }


    public function contracten()
    {
        return $this->hasMany(Contract::class, 'product_id', 'product_id');
    }

    public function factuurregels()
    {
        return $this->hasMany(Factuurregel::class, 'product_id', 'product_id');
    }

    public function onderhoudsOnderdelen()
    {
        return $this->hasMany(OnderhoudOnderdelen::class, 'product_id', 'product_id');
    }

    /**
     * Helper method om voorraad bij te werken en automatisch bijbestellen af te handelen
     */
    public function updateVoorraad($aantal)
    {
        $this->voorraad += $aantal;
        $this->save();

        // Check of automatisch bijbestellen nodig is
        $threshold = config('inkoop.threshold', 20);
        $restockAmount = config('inkoop.restock_amount', 20);

        if ($this->voorraad < $threshold) {
            $medewerkerId = optional(Auth::user())->medewerker ? Auth::user()->medewerker->medewerker_id : null;
            $prijsPerStuk = $this->prijs ?? 0;
            $subtotaal = $prijsPerStuk * $restockAmount;

            $inkoop = Inkoop::create([
                'medewerker_id' => $medewerkerId,
                'datum' => Carbon::now()->format('Y-m-d H:i:s'),
                'totaalbedrag' => $subtotaal,
                'opmerking' => 'Automatisch bijbesteld (voorraad onder ' . $threshold . ')',
            ]);

            InkoopRegel::create([
                'inkoop_id' => $inkoop->inkoop_id,
                'product_id' => $this->product_id,
                'aantal' => $restockAmount,
                'prijs_per_stuk' => $prijsPerStuk,
                'subtotaal' => $subtotaal,
            ]);

            $this->increment('voorraad', $restockAmount);
        }

        return $this;
    }
}
