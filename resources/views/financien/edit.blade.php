@extends('layouts.app')
{{-- make edit form and show everything --}}
<form action="{{ route('financien.update', $klant->id) }}" method="POST">
    @csrf
    

    <div class="mb-4">
        <label for="bkr_check" class="block text-gray-700 font-bold mb-2">BKR Check:</label>
        <select name="bkr_check" id="bkr_check" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="Nog niet gekeurd..." {{ $klant->bkr_check == 'Nog niet gekeurd...' ? 'selected' : '' }}>Nog niet gekeurd...</option>
            <option value="Goed gekeurd!" {{ $klant->bkr_check == 'Goed gekeurd!' ? 'selected' : '' }}>Goed gekeurd!</option>
            <option value="Afgekeurd!" {{ $klant->bkr_check == 'Afgekeurd!' ? 'selected' : '' }}>Afgekeurd!</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="opmerkingen" class="block text-gray-700 font-bold mb-2">Opmerkingen:</label>
        <textarea name="opmerkingen" id="opmerkingen" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $klant->opmerkingen }}</textarea>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Opslaan
        </button>
    </div>
</form>
@endsection

