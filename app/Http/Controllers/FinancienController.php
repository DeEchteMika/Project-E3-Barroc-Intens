<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klant;


class FinancienController extends Controller
{
    // Controller methods for financial management will go here
    public function index()
    {

        $klanten = Klant::orderBy('date', 'desc')->paginate(15);
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
        $klant ->klanrummer = $request->klantnummer;
        $klant ->bedrijfsnaam = $request->bedrijfsnaam;
        $klant ->contactpersoon = $request->contactpersoon;
        $klant ->adres = $request->adres;
        $klant ->postcode = $request->postcode;
        $klant ->plaats = $request->plaats;
        $klant ->telefoon = $request->telefoon;
        $klant ->email = $request->email;
        $klant ->bkr_check = $request->bkr_check;
        $klant ->opmerkingen = $request->opmerkingen;
        $klant->save();


        // Redirect back to the financien index with a success message
        return redirect()->route('financien.index')->with('success', 'Klantgegevens succesvol bijgewerkt.');
    }

    public function destroy($id)
    {
        //
    }
}
