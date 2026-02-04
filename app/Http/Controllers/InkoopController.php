<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Inkoop;
use App\Models\InkoopRegel;

class InkoopController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('naam')->get();
        return view('inkoop.index', compact('products'));

    }

    public function create()
    {
        return view('inkoop.create');
    }

    public function show(Product $product)
    {
        return view('inkoop.show', compact('product'));
    }

    public function restock(Request $request, Product $product)
    {
        $request->validate([
            'hoeveelheid' => 'required|integer|min:1',
        ]);

        $aantal = intval($request->hoeveelheid);
        $product->increment('voorraad', $aantal);

        $medewerkerId = optional(Auth::user())->medewerker ? Auth::user()->medewerker->medewerker_id : null;
        $prijsPerStuk = $product->prijs ?? 0;
        $subtotaal = $prijsPerStuk * $aantal;

        $inkoop = Inkoop::create([
            'medewerker_id' => $medewerkerId,
            'datum' => Carbon::now()->format('Y-m-d H:i:s'),
            'totaalbedrag' => $subtotaal,
            'opmerking' => 'Bijbesteld via inkoop.restock',
        ]);

        InkoopRegel::create([
            'inkoop_id' => $inkoop->inkoop_id,
            'product_id' => $product->product_id,
            'aantal' => $aantal,
            'prijs_per_stuk' => $prijsPerStuk,
            'subtotaal' => $subtotaal,
        ]);

        return redirect()->route('inkoop.index')->with('success', 'Bestelling ontvangen');

    }

    public function orders()
    {
        $bestellingen = Inkoop::with('regels.product', 'medewerker')->orderBy('datum', 'desc')->get();
        return view('inkoop.bestellingen', compact('bestellingen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productnummer' => 'required|string|max:50|unique:product,productnummer',
            'naam' => 'required|string|max:200',
            'omschrijving' => 'nullable|string',
            'prijs' => 'nullable|numeric',
            'voorraad' => 'nullable|integer',
            'heeft_maler' => 'nullable|boolean',
        ]);

        Product::create([
            'productnummer' => $request->productnummer,
            'naam' => $request->naam,
            'omschrijving' => $request->omschrijving,
            'prijs' => $request->prijs ?? 0,
            'voorraad' => $request->voorraad ?? 0,
            'heeft_maler' => $request->has('heeft_maler') ? (bool) $request->heeft_maler : false,
        ]);

        return redirect()->route('inkoop.index')->with('success', 'Product aangemaakt');
    }

    public function edit(Product $product)
    {
        return view('inkoop.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'productnummer' => 'required|string|max:50|unique:product,productnummer,' . $product->product_id . ',product_id',
            'naam' => 'required|string|max:200',
            'omschrijving' => 'nullable|string',
            'prijs' => 'nullable|numeric',
            'voorraad' => 'nullable|integer',
            'heeft_maler' => 'nullable|boolean',
        ]);

        $product->update([
            'productnummer' => $request->productnummer,
            'naam' => $request->naam,
            'omschrijving' => $request->omschrijving,
            'prijs' => $request->prijs ?? 0,
            'voorraad' => $request->voorraad ?? 0,
            'heeft_maler' => $request->has('heeft_maler') ? (bool) $request->heeft_maler : false,
        ]);
        $threshold = config('inkoop.threshold', 5);
        $restockAmount = config('inkoop.restock_amount', 20);

        if ($product->voorraad < $threshold) {

            $product->increment('voorraad', $restockAmount);
        }

        return redirect()->route('inkoop.index')->with('success', 'Product bijgewerkt');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('inkoop.index')->with('success', 'Product verwijderd');
    }
}
