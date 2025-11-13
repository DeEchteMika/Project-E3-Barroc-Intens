<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medewerker extends Model
{
    use HasFactory;

    protected $table = 'medewerker';
    protected $primaryKey = 'medewerker_id';
    public $timestamps = true;

    protected $fillable = [
        'voornaam',
        'achternaam',
        'functie',
        'afdeling_id',
        'email',
        'telefoon',
        'rechten_id',
        'actief',
        'user_id',
    ];

    public function afdeling()
    {
        return $this->belongsTo(Afdeling::class, 'afdeling_id', 'afdeling_id');
    }

    public function rechten()
    {
        return $this->belongsTo(Rechten::class, 'rechten_id', 'rechten_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function verstuurdeBerichten()
    {
        return $this->hasMany(Bericht::class, 'verzender_id', 'medewerker_id');
    }

    public function ontvangenBerichten()
    {
        return $this->hasMany(Bericht::class, 'ontvanger_id', 'medewerker_id');
    }
}
