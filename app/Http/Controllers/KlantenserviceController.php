<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klant;

class KlantenserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('klantenservice.klanten', compact('klanten'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Klant $klant)
    {
        return view('klantenservice.edit', compact('klant'));
    }

    public function updateF(Request $request, Klant $klant)
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

        // Redirect back to the klantenservice index with a success message
        return redirect()->route('klantenservice.index')->with('success', 'Klantgegevens succesvol bijgewerkt.');
    }


    /**
     * Update the specified resource in storage.
     */
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

        // Redirect back to the klantenservice index with a success message
        return redirect()->route('klanten')->with('success', 'Klantgegevens succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
