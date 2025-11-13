<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factuurregel extends Model
{
    use HasFactory;

    protected $table = 'factuurregel';
    protected $primaryKey = 'factuurregel_id';
    public $timestamps = true;

    protected $fillable = [
        'factuur_id',
        'product_id',
        'omschrijving',
        'aantal',
        'prijs_per_stuk',
        'subtotaal',
    ];

    public function factuur()
    {
        return $this->belongsTo(Factuur::class, 'factuur_id', 'factuur_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
