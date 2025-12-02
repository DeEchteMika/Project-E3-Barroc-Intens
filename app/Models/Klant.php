<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProcessCompleted;

class Klant extends Model
{
    use HasFactory;

    protected $table = 'klant';
    protected $primaryKey = 'klant_id';
    public $incrementing = false;
    protected $keyType = 'int';
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
        'bkr_check',
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

    protected static function booted()
    {
        static::updated(function ($klant) {
            if ($klant->isDirty('bkr_check')) {
                $original = $klant->getOriginal('bkr_check');
                $new = $klant->bkr_check;

                if ($original === 'Nog niet gekeurd...' && in_array($new, ['Goed gekeurd!', 'Afgekeurd!'])) {
                    if (!empty($klant->email)) {
                        Mail::to($klant->email)->send(new ProcessCompleted($klant));
                    }
                }
            }
        });
    }

}

