@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('onderhoud.dashboard') }}" class="text-blue-600 hover:text-blue-900 text-sm">
            ← Terug naar dashboard
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mt-4">Nieuw Onderhoudschema</h1>
        <p class="text-gray-600 mt-2">Voeg een nieuw onderhoudschema toe voor een klant</p>
    </div>

    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('onderhoud.store') }}">
            @csrf

            <div class="mb-6">
                <label for="contract_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Contract *
                </label>
                <select name="contract_id" id="contract_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Selecteer een contract --</option>
                    @foreach ($contracts as $contract)
                        <option value="{{ $contract->contract_id }}">
                            {{ $contract->contractnummer }} - {{ $contract->klant->bedrijfsnaam }}
                        </option>
                    @endforeach
                </select>
                @error('contract_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="klant_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Klant *
                </label>
                <select name="klant_id" id="klant_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Selecteer een klant --</option>
                    @foreach ($klanten as $klant)
                        <option value="{{ $klant->klant_id }}">
                            {{ $klant->bedrijfsnaam }} ({{ $klant->contactpersoon }})
                        </option>
                    @endforeach
                </select>
                @error('klant_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="interval_label" class="block text-sm font-medium text-gray-700 mb-2">
                    Onderhoudsinterval *
                </label>
                <select name="interval_label" id="interval_label" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">-- Selecteer interval --</option>
                    <option value="1 maand">Maandelijks (1 maand)</option>
                    <option value="6 maanden">Halfjaarlijks (6 maanden)</option>
                    <option value="1 jaar">Jaarlijks (1 jaar)</option>
                </select>
                @error('interval_label')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded p-4 mb-6">
                <p class="text-blue-800 text-sm">
                    <strong>ℹ️ Let op:</strong> Wanneer u dit onderhoudschema aanmaakt, wordt de volgende onderhouddatum ingesteld op vandaag plus het aantal dagen van het gekozen interval.
                </p>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('onderhoud') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50">
                    Annuleren
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                    Onderhoudschema Aanmaken
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-fill klant when contract is selected
    document.getElementById('contract_id').addEventListener('change', function() {
        const contractId = this.value;
        if (contractId) {
            // In een echte applicatie zou je hier een AJAX call doen
            // Voor nu werkt het handmatig
        }
    });
</script>
@endsection
