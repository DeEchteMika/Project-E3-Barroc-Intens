<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificatie extends Model
{
    use HasFactory;

    protected $table = 'notificatie';
    protected $primaryKey = 'notificatie_id';
    public $timestamps = true;

    protected $fillable = [
        'medewerker_id',
        'type',
        'bericht_tekst',
        'link',
        'gelezen',
    ];

    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'medewerker_id', 'medewerker_id');
    }
}
