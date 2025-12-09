<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storing extends Model
{
    /** @use HasFactory<\Database\Factories\StoringFactory> */
    use HasFactory;

    protected $table = 'storing';
    protected $primaryKey = 'storing_id';
    public $timestamps = true;
    protected $fillable = [
        'naam',
        'beschrijving',
        'status',
        'locatie',
        'bedrijf',
        'datum',
        'klant_id',
        'monteur',
    ];
    public function klant()
    {
        return $this->belongsTo(Klant::class, 'klant_id', 'klant_id');
    }

    public function medewerker()
    {
        return $this->belongsTo(User::class, 'monteur_id', 'id');
    }
}
