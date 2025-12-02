@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-6">Financiën bewerken</h1>

        <form action="{{ route('financien.update', $klant->klant_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="klantnummer" class="block text-sm font-medium text-gray-700 mb-1">Klantnummer</label>
                    <input type="text" name="klantnummer" id="klantnummer" value="{{ $klant->klantnummer }}" class="w-full border rounded py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div>
                    <label for="bedrijfsnaam" class="block text-sm font-medium text-gray-700 mb-1">Bedrijfsnaam</label>
                    <input type="text" name="bedrijfsnaam" id="bedrijfsnaam" value="{{ $klant->bedrijfsnaam }}" class="w-full border rounded py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div>
                    <label for="contactpersoon" class="block text-sm font-medium text-gray-700 mb-1">Contactpersoon</label>
                    <input type="text" name="contactpersoon" id="contactpersoon" value="{{ $klant->contactpersoon }}" class="w-full border rounded py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div>
                    <label for="telefoon" class="block text-sm font-medium text-gray-700 mb-1">Telefoon</label>
                    <input type="text" name="telefoon" id="telefoon" value="{{ $klant->telefoon }}" class="w-full border rounded py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div>
                    <label for="adres" class="block text-sm font-medium text-gray-700 mb-1">Adres</label>
                    <input type="text" name="adres" id="adres" value="{{ $klant->adres }}" class="w-full border rounded py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ $klant->email }}" class="w-full border rounded py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div>
                    <label for="postcode" class="block text-sm font-medium text-gray-700 mb-1">Postcode</label>
                    <input type="text" name="postcode" id="postcode" value="{{ $klant->postcode }}" class="w-full border rounded py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div>
                    <label for="plaats" class="block text-sm font-medium text-gray-700 mb-1">Plaats</label>
                    <input type="text" name="plaats" id="plaats" value="{{ $klant->plaats }}" class="w-full border rounded py-2 px-3 text-gray-700 bg-gray-100 cursor-not-allowed" readonly>
                </div>

                <div class="md:col-span-2">
                    <label for="bkr_check" class="block text-sm font-medium text-gray-700 mb-1">BKR Check</label>
                    <select name="bkr_check" id="bkr_check" class="w-full border rounded py-2 px-3 text-gray-700">
                        <option value="Nog niet gekeurd..." {{ $klant->bkr_check == 'Nog niet gekeurd...' ? 'selected' : '' }}>Nog niet gekeurd...</option>
                        <option value="Goed gekeurd!" {{ $klant->bkr_check == 'Goed gekeurd!' ? 'selected' : '' }}>Goed gekeurd!</option>
                        <option value="Afgekeurd!" {{ $klant->bkr_check == 'Afgekeurd!' ? 'selected' : '' }}>Afgekeurd!</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="opmerkingen" class="block text-sm font-medium text-gray-700 mb-1">Opmerkingen</label>
                    <textarea name="opmerkingen" id="opmerkingen" rows="4" class="w-full border rounded py-2 px-3 text-gray-700">{{ $klant->opmerkingen }}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Opslaan</button>
                <a href="{{ route('financien.index') }}" class="text-sm text-gray-600 hover:underline">Annuleren</a>
            </div>
        </form>
    </div>
</div>
@endsection

