<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnderhoudOnderdelen extends Model
{
    use HasFactory;

    protected $table = 'onderhoud_onderdelen';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'onderhoud_id',
        'product_id',
        'aantal',
    ];

    public function onderhoud()
    {
        return $this->belongsTo(Onderhoud::class, 'onderhoud_id', 'onderhoud_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
