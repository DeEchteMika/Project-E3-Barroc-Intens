<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factuur extends Model
{
    use HasFactory;

    protected $table = 'factuur';
    protected $primaryKey = 'factuur_id';
    public $timestamps = true;

    protected $fillable = [
        'factuurnummer',
        'klant_id',
        'contract_id',
        'datum',
        'periode',
        'totaalbedrag',
        'betalingsvoorwaarden',
        'opmerkingen',
    ];

    public function klant()
    {
        return $this->belongsTo(Klant::class, 'klant_id', 'klant_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'contract_id');
    }

    public function regels()
    {
        return $this->hasMany(Factuurregel::class, 'factuur_id', 'factuur_id');
    }
}
