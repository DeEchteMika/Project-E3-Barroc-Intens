<?php

namespace App\Http\Controllers;

use App\Models\Medewerker;
use App\Models\Storing;
use Illuminate\Http\Request;

class StoringsContoller extends Controller
{
	public function index()
	{
		$storingen = Storing::with(['klant', 'monteur'])
			->orderByDesc('created_at')
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
