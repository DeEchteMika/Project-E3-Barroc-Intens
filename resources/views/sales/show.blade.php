@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold mb-4">Product details</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">Productnummer:</h2>
            <p class="text-gray-700">{{ $product->productnummer }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">Naam:</h2>
            <p class="text-gray-700">{{ $product->naam }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">Omschrijving:</h2>
            <p class="text-gray-700">{{ $product->omschrijving }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">Prijs:</h2>
            <p class="text-gray-700">€ {{ number_format($product->prijs ?? 0, 2, ',', '.') }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">Voorraad:</h2>
            <p class="text-gray-700">{{ $product->voorraad ?? 0 }}</p>
        </div>

        <div>
            <h2 class="text-lg font-medium text-gray-900">Heeft maler:</h2>
            <p class="text-gray-700">{{ $product->heeft_maler ? 'Ja' : 'Nee' }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('sales.overzicht') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700">Terug naar lijst</a>
    </div>
@endsection
