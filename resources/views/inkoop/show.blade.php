@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold mb-4">Product details</h1>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">
            {{ session('success') }}
        </div>
    @endif

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
            <p class="text-gray-700 text-xl font-semibold">{{ $product->voorraad ?? 0 }} stuks</p>
        </div>

        <div>
            <h2 class="text-lg font-medium text-gray-900">Heeft maler:</h2>
            <p class="text-gray-700">{{ $product->heeft_maler ? 'Ja' : 'Nee' }}</p>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6 mt-6">
        <h2 class="text-xl font-semibold mb-4">Voorraad inkopen</h2>

        @if($errors->any())
            <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-800">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inkoop.restock', $product->product_id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="hoeveelheid" class="block text-sm font-medium text-gray-700">Aantal stuks</label>
                <input type="number" name="hoeveelheid" id="hoeveelheid"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                    value="{{ old('hoeveelheid') }}" required min="1">
            </div>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                Voorraad toevoegen
            </button>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('inkoop.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700">Terug naar lijst</a>
    </div>
@endsection
