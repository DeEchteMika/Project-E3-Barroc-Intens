<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InkoopRegel extends Model
{
    use HasFactory;

    protected $table = 'inkoop_regel';
    protected $primaryKey = 'inkoopregel_id';
    public $timestamps = true;

    protected $fillable = [
        'inkoop_id',
        'product_id',
        'aantal',
        'prijs_per_stuk',
        'subtotaal',
    ];

    public function inkoop()
    {
        return $this->belongsTo(Inkoop::class, 'inkoop_id', 'inkoop_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
