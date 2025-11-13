<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bericht extends Model
{
    use HasFactory;

    protected $table = 'bericht';
    protected $primaryKey = 'bericht_id';
    public $timestamps = true;

    protected $fillable = [
        'verzender_id',
        'ontvanger_id',
        'onderwerp',
        'inhoud',
        'datum',
        'gelezen',
    ];

    public function verzender()
    {
        return $this->belongsTo(Medewerker::class, 'verzender_id', 'medewerker_id');
    }

    public function ontvanger()
    {
        return $this->belongsTo(Medewerker::class, 'ontvanger_id', 'medewerker_id');
    }
}
