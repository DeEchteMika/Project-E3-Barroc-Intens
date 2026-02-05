@extends('layouts.app')

@section('content')
{{-- make form to show products with dropdown with numbers --}}
<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Maak een contract aan</h1>
        <form action="{{ route('storeContract') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="product" class="block text-sm font-medium text-gray-700 mb-2">Selecteer een product:</label>
                <select id="product" name="product" class="block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">-- Kies een product --</option>
                    {{-- Loop through products and show them as options --}}
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->naam }} - € {{ number_format($product->prijs, 2, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="aantal" class="block text-sm font-medium text-gray-700 mb-2">Aantal:</label>
                <input type="number" id="aantal" name="aantal" min="1" class="block w-full border border-gray-300 rounded-md shadow-sm p-2" />
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Product toevoegen</button>
            </div>
        </form>
    </div>

@endsection
