@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold mb-4">Nieuwe medewerker toevoegen</h1>

    @if($errors->any())
        <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-800">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medewerker.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="voornaam" class="block text-sm font-medium text-gray-700">Voornaam</label>
            <input type="text" name="voornaam" id="voornaam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('voornaam') }}" required>
        </div>

        <div class="mb-4">
            <label for="achternaam" class="block text-sm font-medium text-gray-700">Achternaam</label>
            <input type="text" name="achternaam" id="achternaam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('achternaam') }}" required>
        </div>

        <div class="mb-4">
            <label for="functie" class="block text-sm font-medium text-gray-700">Functie</label>
            <input type="text" name="functie" id="functie" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('functie') }}">
        </div>

        <div class="mb-4">
            <label for="rechten_id" class="block text-sm font-medium text-gray-700">Afdeling</label>
            <select name="rechten_id" id="rechten_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                <option value="">Kies afdeling</option>
                @foreach($rechten as $recht)
                    <option value="{{ $recht->rechten_id }}" @selected(old('rechten_id') == $recht->rechten_id)>
                        {{ $recht->rol }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail (login)</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('email') }}" required>
        </div>

        <div class="mb-4">
            <label for="telefoon" class="block text-sm font-medium text-gray-700">Telefoon</label>
            <input type="text" name="telefoon" id="telefoon" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('telefoon') }}">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Bevestig wachtwoord</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
        </div>

        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="actief" value="1" class="rounded text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('actief', true))>
                <span class="ml-2 text-sm text-gray-700">Actief</span>
            </label>
        </div>

        <div class="mt-6">
            <button class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Opslaan</button>
            <a href="{{ route('admin') }}" class="ml-3 text-sm text-gray-600">Annuleer</a>
        </div>
    </form>
</div>
@endsection
