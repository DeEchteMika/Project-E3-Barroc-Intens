<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rechten extends Model
{
    use HasFactory;

    protected $table = 'rechten';
    protected $primaryKey = 'rechten_id';
    public $timestamps = true;

    protected $fillable = [
        'rol',
        'toegangsniveau',
        'beschrijving',
    ];

    public function medewerkers()
    {
        return $this->hasMany(Medewerker::class, 'rechten_id', 'rechten_id');
    }
}
