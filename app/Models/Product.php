<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
