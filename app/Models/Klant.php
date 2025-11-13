<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klant extends Model
{
    use HasFactory;

    protected $table = 'klant';
    protected $primaryKey = 'klant_id';
    public $timestamps = true;

    protected $fillable = [
        'klantnummer',
        'bedrijfsnaam',
        'contactpersoon',
        'adres',
        'postcode',
        'plaats',
        'telefoon',
        'email',
        'opmerkingen',
    ];

    public function contracten()
    {
        return $this->hasMany(Contract::class, 'klant_id', 'klant_id');
    }

    public function facturen()
    {
        return $this->hasMany(Factuur::class, 'klant_id', 'klant_id');
    }
}
