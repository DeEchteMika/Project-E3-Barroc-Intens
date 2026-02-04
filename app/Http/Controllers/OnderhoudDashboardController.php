<?php

namespace App\Http\Controllers;

use App\Models\OnderhoudSchema;
use App\Models\Contract;
use App\Models\Klant;
use App\Models\Medewerker;
use App\Services\OnderhoudService;
use App\Mail\MonteurToegewezen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OnderhoudDashboardController extends Controller
{
    protected $onderhoudService;

    public function __construct(OnderhoudService $onderhoudService)
    {
        $this->onderhoudService = $onderhoudService;
    }

    /**
     * Show the maintenance dashboard
     */
    public function index()
    {
        $this->onderhoudService->syncCustomerIntervalsToSchemas();
        $summary = $this->onderhoudService->getDashboardSummary();
        $allMaintenance = $this->onderhoudService->getAllMaintenance();

        // Haal monteurs op (alleen medewerkers met functie 'Monteur')
        $monteurs = Medewerker::where('actief', true)
            ->where('functie', 'Monteur')
            ->orderBy('voornaam')
            ->orderBy('achternaam')
            ->get();

        return view('onderhoud.index', [
            'summary' => $summary,
            'dueSoon' => $summary['due_soon'],
            'overdue' => $summary['overdue'],
            'allMaintenance' => $allMaintenance,
            'monteurs' => $monteurs,
        ]);
    }

    /**
     * Show create form for new maintenance schema
     */
    public function create()
    {
        $contracts = Contract::with('klant')->get();
        $klanten = Klant::all();

        return view('onderhoud.create', [
            'contracts' => $contracts,
            'klanten' => $klanten,
        ]);
    }

    /**
     * Show list of customers needing maintenance
     */
    public function list()
    {
        $maintenanceDue = $this->onderhoudService->getMaintenanceDueOrOverdue();

        // Haal monteurs op (alleen medewerkers met functie 'Monteur')
        $monteurs = Medewerker::where('actief', true)
            ->where('functie', 'Monteur')
            ->orderBy('voornaam')
            ->orderBy('achternaam')
            ->get();

        return view('onderhoud.list', [
            'maintenance' => $maintenanceDue,
            'monteurs' => $monteurs,
        ]);
    }

    /**
     * Store a new maintenance schema
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'contract_id' => 'required|exists:contract,contract_id',
            'klant_id' => 'required|exists:klant,klant_id',
            'interval_label' => 'required|in:1 maand,6 maanden,1 jaar',
        ]);

        $interval = match ($validated['interval_label']) {
            '1 maand' => OnderhoudService::INTERVAL_1_MAAND,
            '6 maanden' => OnderhoudService::INTERVAL_6_MAANDEN,
            '1 jaar' => OnderhoudService::INTERVAL_1_JAAR,
        };

        $this->onderhoudService->createMaintenanceSchema(
            $validated['contract_id'],
            $validated['klant_id'],
            $interval
        );

        return redirect()->route('onderhoud.dashboard')
            ->with('success', 'Onderhoud schema succesvol aangemaakt');
    }

    /**
     * Mark maintenance as completed
     */
    public function complete(Request $request, $onderhoudSchemaId)
    {
        try {
            $this->onderhoudService->completeMaintenanceAndScheduleNext($onderhoudSchemaId);

            return redirect()->back()
                ->with('success', 'Onderhoud voltooid en volgende onderhoud ingepland');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Deactivate maintenance schema
     */
    public function deactivate($onderhoudSchemaId)
    {
        $this->onderhoudService->deactivateSchema($onderhoudSchemaId);

        return redirect()->back()
            ->with('success', 'Onderhoudschema gedeactiveerd');
    }

    /**
     * Assign a monteur to maintenance and send email to customer
     */
    public function assignMonteur(Request $request, $onderhoudSchemaId)
    {
        $validated = $request->validate([
            'monteur_id' => 'required|exists:medewerker,medewerker_id',
        ]);

        try {
            $onderhoud = OnderhoudSchema::findOrFail($onderhoudSchemaId);
            $monteur = Medewerker::findOrFail($validated['monteur_id']);

            // Update het onderhoud met de monteur
            $onderhoud->update([
                'monteur_id' => $validated['monteur_id']
            ]);

            // Verstuur email naar de klant
            if ($onderhoud->klant && $onderhoud->klant->email) {
                Mail::to($onderhoud->klant->email)
                    ->send(new MonteurToegewezen($onderhoud, $monteur));
            }

            return redirect()->back()
                ->with('success', 'Monteur toegewezen en klant is geïnformeerd per email');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Fout bij het toewijzen van monteur: ' . $e->getMessage());
        }
    }

    /**
     * Show customer maintenance schedule
     */
    public function customerSchedule($klantId)
    {
        $schedule = $this->onderhoudService->getCustomerMaintenanceSchedule($klantId);

        return view('onderhoud.customer-schedule', [
            'schedule' => $schedule,
        ]);
    }
}
