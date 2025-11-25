@extends('layouts.app')

@section('content')
    <h1>Klanten</h1>
    <!-- Add your content here -->
    <!-- maak overzicht van alle klanten -->
    <div class="overflow-x-auto bg-white shadow rounded-lg mt-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klantnummer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bedrijfsnaam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contactpersoon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adres</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Postcode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plaats</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefoon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">BKR Check</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Opmerkingen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aanpassen</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($klanten as $k)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $k->klantnummer }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $k->bedrijfsnaam }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $k->contactpersoon }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $k->adres }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $k->postcode }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $k->plaats }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $k->telefoon }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $k->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($k->bkr_check === 'Goed gekeurd!')
                            <span class="text-green-600 font-semibold">✔ Goed gekeurd!</span>
                        @elseif($k->bkr_check === 'Afgekeurd!')
                            <span class="text-red-600 font-semibold">✖ Afgekeurd!</span>
                        @else
                            <span class="text-gray-600 font-semibold">Nog niet gekeurd...</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $k->opmerkingen }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                        <a href="{{ route('financien.edit', $k->klantnummer) }}" class="text-blue-600 hover:text-blue-900">Aanpassen</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection
