@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold mb-4">Nieuwe Storing Aanmaken</h1>
    @if($errors->any())
        <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-800">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('storingen.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
            <input type="text" name="naam" id="naam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('naam') }}" required>
        </div>

        <div class="mb-4">
            <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving</label>
            <textarea name="beschrijving" id="beschrijving" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>{{ old('beschrijving') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                <option value="open" {{ old('status', 'open') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="in behandeling" {{ old('status') == 'in behandeling' ? 'selected' : '' }}>In Behandeling</option>
                <option value="opgelost" {{ old('status') == 'opgelost' ? 'selected' : '' }}>Opgelost</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="locatie" class="block text-sm font-medium text-gray-700">Locatie</label>
            <input type="text" name="locatie" id="locatie" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('locatie') }}">
        </div>

        <div class="mb-4">
            <label for="bedrijf" class="block text-sm font-medium text-gray-700">Bedrijf</label>
            <input type="text" name="bedrijf" id="bedrijf" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('bedrijf') }}">
        </div>

        <div class="mb-4">
            <label for="datum" class="block text-sm font-medium text-gray-700">Datum</label>
            <input type="datetime-local" name="datum" id="datum" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('datum') }}">
        </div>

        <div class="mb-4">
            <label for="klant_id" class="block text-sm font-medium text-gray-700">Klant</label>
            <select name="klant_id" id="klant_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                <option value="">Selecteer een klant</option>
                @foreach($klanten as $klant)
                    <option value="{{ $klant->klant_id }}" {{ old('klant_id') == $klant->klant_id ? 'selected' : '' }}>
                        {{ $klant->bedrijfsnaam }} - {{ $klant->contactpersoon }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="monteur_id" class="block text-sm font-medium text-gray-700">Monteur</label>
            <select name="monteur_id" id="monteur_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                <option value="">Selecteer een monteur (optioneel)</option>
                @foreach($monteurs as $monteur)
                    <option value="{{ $monteur->medewerker_id }}" {{ old('monteur_id') == $monteur->medewerker_id ? 'selected' : '' }}>
                        {{ $monteur->voornaam }} {{ $monteur->achternaam }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-6">
            <button class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Opslaan</button>
            <a href="{{ route('storingen.index') }}" class="ml-3 text-sm text-gray-600">Annuleer</a>
        </div>
    </form>
</div>
@endsection
