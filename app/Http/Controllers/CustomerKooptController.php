<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //fill store function, and make it so that it checks if the aantal is available in stock
        $validatedData = $request->validate([
            'klant_id' => 'required|exists:klanten,id',
            'product_id' => 'required|exists:products,id',
            'aantal' => 'required|integer|min:1',
        ]);
        $product = Product::find($validatedData['product_id']);
        if ($product->stock >= $validatedData['aantal']) {
            // Reduce stock
            $product->stock -= $validatedData['aantal'];
            $product->save();

            // Here you would typically create a contract record in the database
            // For example:
            Contract::create([
            'klant_id' => $validatedData['klant_id'],
            'product_id' => $validatedData['product_id'],
            'aantal' => $validatedData['aantal'],
            // other contract details...
            ]);

            return redirect()->route('sales.item')->with('success', 'Contract created successfully!');
                } else {
            return redirect()->back()->withErrors(['aantal' => 'Not enough stock available.']);
        }
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
