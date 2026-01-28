@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold mb-4">Product bewerken</h1>

    @if($errors->any())
        <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-800">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inkoop.update', $product->product_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="productnummer" class="block text-sm font-medium text-gray-700">Productnummer</label>
            <input type="text" name="productnummer" id="productnummer"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                value="{{ old('productnummer', $product->productnummer) }}" required>
        </div>

        <div class="mb-4">
            <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
            <input type="text" name="naam" id="naam"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                value="{{ old('naam', $product->naam) }}" required>
        </div>

        <div class="mb-4">
            <label for="omschrijving" class="block text-sm font-medium text-gray-700">Omschrijving</label>
            <textarea name="omschrijving" id="omschrijving"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ old('omschrijving', $product->omschrijving) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs</label>
                <input type="number" step="0.01" name="prijs" id="prijs"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                    value="{{ old('prijs', $product->prijs) }}">
            </div>
            <div>
                <label for="voorraad" class="block text-sm font-medium text-gray-700">Voorraad</label>
                <input type="number" name="voorraad" id="voorraad"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                    value="{{ old('voorraad', $product->voorraad) }}">
            </div>
        </div>

        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="heeft_maler" id="heeft_maler" value="1"
                    class="rounded text-indigo-600 shadow-sm focus:ring-indigo-500"
                    {{ old('heeft_maler', $product->heeft_maler) ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-700">Heeft maler</span>
            </label>
        </div>

        <div class="mt-6">
            <button class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Bijwerken
            </button>
            <a href="{{ route('inkoop.index') }}" class="ml-3 text-sm text-gray-600">Annuleer</a>
        </div>
    </form>
</div>
@endsection
