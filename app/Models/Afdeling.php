<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afdeling extends Model
{
    use HasFactory;

    protected $table = 'afdeling';
    protected $primaryKey = 'afdeling_id';
    public $timestamps = true;

    protected $fillable = [
        'naam',
        'hoofd_id',
        'beschrijving',
    ];

    public function hoofd()
    {
        return $this->belongsTo(Medewerker::class, 'hoofd_id', 'medewerker_id');
    }

    public function medewerkers()
    {
        return $this->hasMany(Medewerker::class, 'afdeling_id', 'afdeling_id');
    }
}
