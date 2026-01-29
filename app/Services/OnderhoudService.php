<?php

namespace App\Services;

use App\Models\OnderhoudSchema;
use App\Models\Klant;
use App\Models\Onderhoud;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class OnderhoudService
{
    const INTERVAL_1_MAAND = [
        'dagen' => 30,
        'label' => '1 maand',
    ];

    const INTERVAL_6_MAANDEN = [
        'dagen' => 180,
        'label' => '6 maanden',
    ];

    const INTERVAL_1_JAAR = [
        'dagen' => 365,
        'label' => '1 jaar',
    ];

    /**
     * Get all maintenance due soon (within 3 days)
     */
    public function getMaintenanceDueSoon($days = 3): Collection
    {
        $targetDate = Carbon::now()->addDays($days);

        return OnderhoudSchema::where('actief', true)
            ->where('volgende_onderhoud', '<=', $targetDate)
            ->where('volgende_onderhoud', '>', Carbon::now())
            ->with(['klant', 'contract'])
            ->orderBy('volgende_onderhoud', 'asc')
            ->get();
    }

    /**
     * Get all overdue maintenance
     */
    public function getOverdueMaintenance(): Collection
    {
        return OnderhoudSchema::where('actief', true)
            ->where('volgende_onderhoud', '<', Carbon::now())
            ->with(['klant', 'contract'])
            ->orderBy('volgende_onderhoud', 'asc')
            ->get();
    }

    /**
     * Get all maintenance (due soon + overdue)
     */
    public function getMaintenanceDueOrOverdue($days = 3): Collection
    {
        $targetDate = Carbon::now()->addDays($days);

        return OnderhoudSchema::where('actief', true)
            ->where('volgende_onderhoud', '<=', $targetDate)
            ->with(['klant', 'contract'])
            ->orderBy('volgende_onderhoud', 'asc')
            ->get();
    }

    /**
     * Create maintenance schema for a contract
     */
    public function createMaintenanceSchema($contractId, $klantId, $interval = self::INTERVAL_1_JAAR)
    {
        $volgendeOnderhoud = Carbon::now()->addDays($interval['dagen']);

        return OnderhoudSchema::create([
            'contract_id' => $contractId,
            'klant_id' => $klantId,
            'interval_dagen' => $interval['dagen'],
            'interval_label' => $interval['label'],
            'volgende_onderhoud' => $volgendeOnderhoud,
            'actief' => true,
        ]);
    }

    /**
     * Update maintenance date after completing maintenance
     */
    public function completeMaintenanceAndScheduleNext($onderhoudSchemaId, $onderhoudId = null)
    {
        $schema = OnderhoudSchema::find($onderhoudSchemaId);

        if (!$schema) {
            throw new \Exception('Onderhoud schema niet gevonden');
        }

        // Update laatste_onderhoud to now
        $schema->laatste_onderhoud = Carbon::now();

        // Calculate next maintenance
        $schema->volgende_onderhoud = Carbon::now()->addDays($schema->interval_dagen);

        $schema->save();

        return $schema;
    }

    /**
     * Get summary for dashboard
     */
    public function getDashboardSummary()
    {
        $dueSoon = $this->getMaintenanceDueSoon();
        $overdue = $this->getOverdueMaintenance();

        return [
            'due_soon_count' => $dueSoon->count(),
            'overdue_count' => $overdue->count(),
            'total_due' => $dueSoon->count() + $overdue->count(),
            'due_soon' => $dueSoon,
            'overdue' => $overdue,
        ];
    }

    /**
     * Get maintenance schedule for a specific customer
     */
    public function getCustomerMaintenanceSchedule($klantId)
    {
        return OnderhoudSchema::where('klant_id', $klantId)
            ->where('actief', true)
            ->with(['contract'])
            ->orderBy('volgende_onderhoud', 'asc')
            ->get();
    }

    /**
     * Deactivate maintenance schema
     */
    public function deactivateSchema($onderhoudSchemaId)
    {
        $schema = OnderhoudSchema::find($onderhoudSchemaId);
        if ($schema) {
            $schema->actief = false;
            $schema->save();
        }
        return $schema;
    }
}
