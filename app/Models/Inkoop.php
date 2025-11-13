<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inkoop extends Model
{
    use HasFactory;

    protected $table = 'inkoop';
    protected $primaryKey = 'inkoop_id';
    public $timestamps = true;

    protected $fillable = [
        'medewerker_id',
        'datum',
        'totaalbedrag',
        'opmerking',
    ];

    public function medewerker()
    {
        return $this->belongsTo(Medewerker::class, 'medewerker_id', 'medewerker_id');
    }

    public function regels()
    {
        return $this->hasMany(InkoopRegel::class, 'inkoop_id', 'inkoop_id');
    }
}
