<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onderhoud extends Model
{
    use HasFactory;

    protected $table = 'onderhoud';
    protected $primaryKey = 'onderhoud_id';
    public $timestamps = true;

    protected $fillable = [
        'contract_id',
        'klant_id',
        'monteur_id',
        'datum',
        'checklist_voltooid',
        'goedgekeurd',
        'storingscode',
        'storing_verholpen',
        'opmerkingen',
        'handtekening_url',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'contract_id');
    }

    public function klant()
    {
        return $this->belongsTo(Klant::class, 'klant_id', 'klant_id');
    }

    public function monteur()
    {
        return $this->belongsTo(Medewerker::class, 'monteur_id', 'medewerker_id');
    }

    public function onderdelen()
    {
        return $this->hasMany(OnderhoudOnderdelen::class, 'onderhoud_id', 'onderhoud_id');
    }
}
