<?php

namespace App\Http\Controllers;

use App\Models\Medewerker;
use App\Models\Onderhoud;
use App\Models\Storing;
use Illuminate\Http\Request;

class StoringsContoller extends Controller
{
	public function index()
	{
		$user = auth()->user();
		$medewerker = $user->medewerker;

		// Controleer of user toegang heeft tot deze pagina
		if (!$medewerker) {
			abort(403, 'U hebt geen toegang tot deze pagina.');
		}

		// Bepaal of het een leidinggevende is (management, onderhoud, admin)
		$isManager = in_array(strtolower($medewerker->functie), ['management', 'onderhoud', 'admin']);

		// Haal storingen op
		$query = Storing::with(['klant', 'monteur']);

		// Monteurs zien alleen hun eigen storingen
		if (!$isManager) {
			$query->where('monteur_id', $medewerker->medewerker_id);
		}
		// Managers/Admin/Hooft Onderhoud zien ALLE storingen

		$storingen = $query->orderByDesc('created_at')
			->paginate(15);

		return view('onderhoud.storingen', compact('storingen'));
	}

	public function edit(Storing $storing)
	{
		$monteurs = Medewerker::where('functie', 'Monteur')
			->where('actief', true)
			->orderBy('achternaam')
			->orderBy('voornaam')
			->get();

		return view('onderhoud.storingen-edit', compact('storing', 'monteurs'));
	}

	public function show(Storing $storing)
	{
		$storing->load(['klant', 'monteur', 'onderhoudswerk']);
		return view('onderhoud.storingen-show', compact('storing'));
	}

	public function update(Request $request, Storing $storing)
	{
		$data = $request->validate([
			'status' => 'required|in:open,in behandeling,opgelost',
			'monteur_id' => 'nullable|exists:medewerker,medewerker_id',
			'checklist_voltooid' => 'boolean',
			'goedgekeurd' => 'boolean',
			'storingscode' => 'nullable|string|max:50',
			'storing_verholpen' => 'boolean',
			'opmerkingen' => 'nullable|string',
			'handtekening_url' => 'nullable|string',
		]);

		// Update storing velden
		$storingData = [
			'status' => $data['status'],
			'monteur_id' => $data['monteur_id'] ?? null,
		];
		$storing->update($storingData);

		// Bewaar onderhoud werkzaamheden
		$onderhoudData = [
			'checklist_voltooid' => $data['checklist_voltooid'] ?? false,
			'goedgekeurd' => $data['goedgekeurd'] ?? false,
			'storingscode' => $data['storingscode'] ?? null,
			'storing_verholpen' => $data['storing_verholpen'] ?? false,
			'opmerkingen' => $data['opmerkingen'] ?? null,
			'handtekening_url' => $data['handtekening_url'] ?? null,
		];

		// Zoek of werk bestaand onderhoud bij, anders create
		if ($storing->onderhoudswerk) {
			$storing->onderhoudswerk->update($onderhoudData);
		} else {
			$onderhoudData['storingscode'] = $storing->storing_id;
			Onderhoud::create($onderhoudData);
		}

		return redirect()
			->route('storingen.show', $storing->storing_id)
			->with('success', 'Storing bijgewerkt.');
	}
}
