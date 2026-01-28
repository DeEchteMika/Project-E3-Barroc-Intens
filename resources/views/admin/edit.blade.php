@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold mb-4">Medewerker bewerken</h1>

    @if($errors->any())
        <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-800">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medewerker.update', $medewerker->medewerker_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="voornaam" class="block text-sm font-medium text-gray-700">Voornaam</label>
            <input type="text" name="voornaam" id="voornaam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('voornaam', $medewerker->voornaam) }}" required>
        </div>

        <div class="mb-4">
            <label for="achternaam" class="block text-sm font-medium text-gray-700">Achternaam</label>
            <input type="text" name="achternaam" id="achternaam" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('achternaam', $medewerker->achternaam) }}" required>
        </div>

        <div class="mb-4">
            <label for="functie" class="block text-sm font-medium text-gray-700">Functie</label>
            <select name="functie" id="functie" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                <option value="Medewerker" @selected(old('functie', $medewerker->functie ?? 'Medewerker') == 'Medewerker')>Medewerker</option>
                <option value="Monteur" @selected(old('functie', $medewerker->functie) == 'Monteur')>Monteur</option>
                <option value="Hoofd Financiële Administratie" @selected(old('functie', $medewerker->functie) == 'Hoofd Financiële Administratie')>Hoofd Financiële Administratie</option>
                <option value="Hoofd Sales" @selected(old('functie', $medewerker->functie) == 'Hoofd Sales')>Hoofd Sales</option>
                <option value="Hoofd Inkoop" @selected(old('functie', $medewerker->functie) == 'Hoofd Inkoop')>Hoofd Inkoop</option>
                <option value="Hoofd Maintenance" @selected(old('functie', $medewerker->functie) == 'Hoofd Maintenance')>Hoofd Maintenance</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="rechten_id" class="block text-sm font-medium text-gray-700">Afdeling</label>
            <select name="rechten_id" id="rechten_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                <option value="">Kies afdeling</option>
                @foreach($rechten as $recht)
                    <option value="{{ $recht->rechten_id }}" @selected(old('rechten_id', $medewerker->rechten_id) == $recht->rechten_id)>
                        {{ $recht->rol }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('email', $medewerker->email) }}" required>
        </div>

        <div class="mb-4">
            <label for="telefoon" class="block text-sm font-medium text-gray-700">Telefoon</label>
            <input type="text" name="telefoon" id="telefoon" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ old('telefoon', $medewerker->telefoon) }}">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Nieuw wachtwoord (optioneel)</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Bevestig wachtwoord</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
        </div>

        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="actief" value="1" class="rounded text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('actief', $medewerker->actief))>
                <span class="ml-2 text-sm text-gray-700">Actief</span>
            </label>
        </div>

        <div class="mt-6">
            <button class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Opslaan</button>
            <a href="{{ route('admin') }}" class="ml-3 text-sm text-gray-600">Annuleer</a>
        </div>
    </form>

    @if($medewerker->user)
    <div class="mt-8 pt-6 border-t border-gray-200">
        <h2 class="text-lg font-semibold mb-4">Wachtwoord Reset</h2>
        <p class="text-sm text-gray-600 mb-4">
            Verstuur een wachtwoord reset e-mail naar <strong>{{ $medewerker->email }}</strong>.
            De medewerker ontvangt een link om een nieuw wachtwoord in te stellen.
        </p>
        <form action="{{ route('medewerker.sendResetEmail', $medewerker->medewerker_id) }}" method="POST" onsubmit="return confirm('Weet u zeker dat u een wachtwoord reset mail wilt versturen?');">
            @csrf
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Wachtwoord Reset Mail Versturen
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
