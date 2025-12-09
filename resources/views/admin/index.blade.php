@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Medewerkers beheren</h1>
        <a href="{{ route('medewerker.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">Nieuwe medewerker</a>
    </div>

    @if(session('status'))
        <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-800">
            <p class="font-semibold">Validatiefouten:</p>
            <ul class="list-disc list-inside space-y-1 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-900">Bestaande medewerkers</h2>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Naam</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">E-mail</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Functie</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">afdeling</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actief</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Acties</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($medewerkers as $medewerker)
                        <tr class="align-top">
                            <td class="px-4 py-3 text-sm text-gray-900 font-medium">
                                {{ $medewerker->voornaam }} {{ $medewerker->achternaam }}
                                @if ($medewerker->user)
                                    <span class="ml-2 inline-flex items-center text-xs text-green-700 bg-green-100 rounded px-2 py-0.5">Login actief</span>
                                @else
                                    <span class="ml-2 inline-flex items-center text-xs text-amber-700 bg-amber-100 rounded px-2 py-0.5">Geen login</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $medewerker->email ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $medewerker->functie ?? '—' }}</td>                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $medewerker->rechten->rol ?? '—' }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($medewerker->actief)
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800">Actief</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-semibold text-gray-800">Inactief</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-right">
                                <a href="{{ route('medewerker.edit', $medewerker->medewerker_id) }}" class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm mr-2">Bewerken</a>
                                <form action="{{ route('medewerker.destroy', $medewerker->medewerker_id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze medewerker wilt verwijderen?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-sm text-gray-500">Nog geen medewerkers.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
