<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class InkoopController extends Controller
{
    // Show list of products (management for inkoop)
    public function index()
    {
        $products = Product::orderBy('naam')->get();
        return view('inkoop.index', compact('products'));
    }

    // Form to create a new product
    public function create()
    {
        return view('inkoop.create');
    }

    public function show(Product $product)
    {
        return view('inkoop.show', compact('product'));
    }

    // Store a new product in the database
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

        return redirect()->route('inkoop.index')->with('success', 'Product bijgewerkt');
    }




    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('inkoop.index')->with('success', 'Product verwijderd');
    }
}
