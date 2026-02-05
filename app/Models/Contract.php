<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contract';
    protected $primaryKey = 'contract_id';
    public $timestamps = true;

    protected $fillable = [
        'klant_id',
        'product_id',
        'contractnummer',
        'startdatum',
        'einddatum',
        'maandbedrag',
        'opmerkingen',
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'contract_product', 'contract_id', 'product_id')
            ->withPivot('aantal')
            ->withTimestamps();
    }

    public function klant()
    {
        return $this->belongsTo(Klant::class, 'klant_id', 'klant_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function facturen()
    {
        return $this->hasMany(Factuur::class, 'contract_id', 'contract_id');
    }

    public function onderhoudSchemas()
    {
        return $this->hasMany(OnderhoudSchema::class, 'contract_id', 'contract_id');
    }
}
