<?php

namespace App\Console\Commands;

use App\Models\OnderhoudSchema;
use App\Models\Notificatie;
use App\Models\Medewerker;
use App\Services\OnderhoudService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckMaintenanceDue extends Command
{
    protected $signature = 'onderhoud:check-due {--days=3 : Number of days to check ahead}';
    protected $description = 'Check for maintenance due soon and create notifications';

    protected $onderhoudService;

    public function __construct(OnderhoudService $onderhoudService)
    {
        parent::__construct();
        $this->onderhoudService = $onderhoudService;
    }

    public function handle()
    {
        $days = $this->option('days');

        // Get maintenance due soon
        $maintenanceDueSoon = $this->onderhoudService->getMaintenanceDueSoon($days);

        $this->info("Checking for maintenance due in the next {$days} days...");
        $this->info("Found " . $maintenanceDueSoon->count() . " items");

        foreach ($maintenanceDueSoon as $maintenance) {
            // Check if notification already exists for today
            $existingNotification = Notificatie::where('onderhoud_schema_id', $maintenance->onderhoud_schema_id)
                ->whereDate('created_at', Carbon::today())
                ->exists();

            if (!$existingNotification) {
                // Get all medewerkers for notification
                $medewerkers = Medewerker::all();

                foreach ($medewerkers as $medewerker) {
                    Notificatie::create([
                        'medewerker_id' => $medewerker->medewerker_id,
                        'onderhoud_schema_id' => $maintenance->onderhoud_schema_id,
                        'klant_id' => $maintenance->klant_id,
                        'type' => 'onderhoud_due_soon',
                        'bericht_tekst' => "Onderhoud vervalt binnenkort voor {$maintenance->klant->bedrijfsnaam} op " .
                                          $maintenance->volgende_onderhoud->format('d-m-Y H:i'),
                        'link' => '/onderhoud/dashboard',
                        'gelezen' => false,
                    ]);
                }

                $this->info("✓ Notificatie aangemaakt voor {$maintenance->klant->bedrijfsnaam}");
            }
        }

        $this->info('Command completed successfully!');
    }
}
