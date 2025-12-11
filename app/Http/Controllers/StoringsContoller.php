<?php

namespace App\Http\Controllers;

use App\Models\Medewerker;
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
		return view('onderhoud.storingen-show', compact('storing'));
	}

	public function update(Request $request, Storing $storing)
	{
		$data = $request->validate([
			'status' => 'required|in:open,in behandeling,opgelost',
			'monteur_id' => 'nullable|exists:medewerker,medewerker_id',
		]);

		$storing->update($data);

		return redirect()
			->route('storingen.index')
			->with('success', 'Storing bijgewerkt.');
	}
}
