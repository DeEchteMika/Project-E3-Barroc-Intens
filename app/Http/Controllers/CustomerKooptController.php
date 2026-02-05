<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contract;
use App\Models\Product;
use App\Models\Klant;

class CustomerKooptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $klanten = Klant::all();

        return view('sales.item', compact('products', 'klanten'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $klanten = Klant::all();
        return view('sales.createContract', compact('products', 'klanten'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'klant_id'   => 'required|exists:klant,klant_id',
        'product_id'=> 'required|exists:product,product_id',
        'aantal'    => 'required|integer|min:1'
    ]);

    return DB::transaction(function () use ($validated) {

        // Lock product row
        $product = Product::where('product_id', $validated['product_id'])
            ->lockForUpdate()
            ->first();

        if ($product->voorraad < $validated['aantal']) {
            return back()->withErrors(['aantal' => 'Not enough stock available']);
        }

        // Reduce stock
        $product->voorraad -= $validated['aantal'];
        $product->save();

        // Create contract
        $contract = Contract::create([
            'klant_id' => $validated['klant_id'],
        ]);

        // Attach product to contract with quantity
        $contract->products()->attach(
            $validated['product_id'],
            ['aantal' => $validated['aantal']]
        );

        return redirect()
            ->route('sales.item')
            ->with('success', 'Contract created successfully');
    });
}

    /**
     * Display the specified resource.
     */
        public function show(Product $product, Klant $klant)
    {
        return view('sales.item', compact('product', 'klant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
