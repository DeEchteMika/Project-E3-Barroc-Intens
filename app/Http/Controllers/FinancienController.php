<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klant;


class FinancienController extends Controller
{
    // Controller methods for financial management will go here
    public function index()
    {
        $klanten = Klant::orderByRaw("
    CASE
        WHEN bkr_check = 'Nog niet gekeurd...' THEN 0
        WHEN bkr_check = 'Goed gekeurd!' THEN 1
        WHEN bkr_check = 'Afgekeurd!' THEN 2
        ELSE 3
    END
")->get();
        return view('financien.index', compact('klanten'));
    }

    public function create()
    {
        return view('financien.create');
    }

    public function store(Request $request)
    {
        // Logic to store financial data
    }

    public function show($id)
    {
        //
    }

    public function edit(Klant $klant)
    {
        return view('financien.edit', compact('klant'));
    }


    public function update(Request $request, Klant $klant)
    {
        $klant->update([
            'klantnummer'   => $request->klantnummer,
            'bedrijfsnaam'  => $request->bedrijfsnaam,
            'contactpersoon'=> $request->contactpersoon,
            'adres'         => $request->adres,
            'postcode'      => $request->postcode,
            'plaats'        => $request->plaats,
            'telefoon'      => $request->telefoon,
            'email'         => $request->email,
            'bkr_check'     => $request->bkr_check,
            'opmerkingen'   => $request->opmerkingen,
        ]);

        // Redirect back to the financien index with a success message
        return redirect()->route('financien.index')->with('success', 'Klantgegevens succesvol bijgewerkt.');
    }


    public function destroy($id)
    {
        //
    }
}
