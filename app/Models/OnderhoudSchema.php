<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OnderhoudSchema extends Model
{
    use HasFactory;

    protected $table = 'onderhoud_schema';
    protected $primaryKey = 'onderhoud_schema_id';
    public $timestamps = true;

    protected $fillable = [
        'contract_id',
        'klant_id',
        'interval_dagen',
        'interval_label',
        'volgende_onderhoud',
        'laatste_onderhoud',
        'actief',
        'opmerkingen',
    ];

    protected $casts = [
        'volgende_onderhoud' => 'datetime',
        'laatste_onderhoud' => 'datetime',
        'actief' => 'boolean',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'contract_id');
    }

    public function klant()
    {
        return $this->belongsTo(Klant::class, 'klant_id', 'klant_id');
    }

    /**
     * Check if onderhoud is due soon (within 3 days)
     */
    public function isDueSoon($days = 3)
    {
        $dueDate = Carbon::parse($this->volgende_onderhoud);
        return $dueDate->diffInDays(Carbon::now(), false) <= $days && $dueDate->isFuture();
    }

    /**
     * Check if onderhoud is overdue
     */
    public function isOverdue()
    {
        return Carbon::parse($this->volgende_onderhoud)->isPast();
    }

    /**
     * Get days until maintenance
     */
    public function daysUntilMaintenance()
    {
        $minutes = Carbon::parse($this->volgende_onderhoud)->diffInMinutes(Carbon::now(), false);
        return round(abs($minutes) / 60, 2);
    }
}
