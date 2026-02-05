@extends('layouts.app')

@section('content')

<div class="max-w-full mx-auto mt-6 px-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-semibold text-gray-900">Klanten</h1>
    </div>

    @if(session('success'))
        <div class="mb-3 px-3 py-2 rounded bg-green-50 border border-green-200 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg">
        <div class="p-3">
            <!-- table-fixed + colgroup so columns keep predictable widths and opmerkingen gets more room -->
            <div class="w-full">
                <table class="min-w-full table-fixed text-sm">
                    <colgroup>
                        <col style="width:8%">
                        <col style="width:18%">
                        <col style="width:10%">
                        <col style="width:18%">
                        <col style="width:6%">
                        <col style="width:8%">
                        <col style="width:7%">
                        <col style="width:8%">
                        <col style="width:5%">
                        <col style="width:10%"> <!-- Opmerkingen: larger -->
                        <col style="width:6%">
                    </colgroup>
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Klantnr</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Bedrijfsnaam</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Contact</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Adres</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Postcode</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Plaats</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Tel</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Email</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">BKR</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Opmerkingen</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-600 uppercase">Actie</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($klanten as $k)
                            <tr class="align-top hover:bg-gray-50">
                                <td class="px-3 py-2 text-gray-700">{{ $k->klantnummer }}</td>
                                <td class="px-3 py-2 text-gray-700 truncate" title="{{ $k->bedrijfsnaam }}">{{ $k->bedrijfsnaam }}</td>
                                <td class="px-3 py-2 text-gray-700 truncate" title="{{ $k->contactpersoon }}">{{ $k->contactpersoon }}</td>
                                <td class="px-3 py-2 text-gray-700 truncate" title="{{ $k->adres }}">{{ $k->adres }}</td>
                                <td class="px-3 py-2 text-gray-700">{{ $k->postcode }}</td>
                                <td class="px-3 py-2 text-gray-700 truncate" title="{{ $k->plaats }}">{{ $k->plaats }}</td>
                                <td class="px-3 py-2 text-gray-700 truncate" title="{{ $k->telefoon }}">{{ $k->telefoon }}</td>
                                <td class="px-3 py-2 text-gray-700 truncate" title="{{ $k->email }}">{{ $k->email }}</td>
                                <td class="px-3 py-2">
                                    @if($k->bkr_check === 'Goed gekeurd!')
                                        <span class="inline-block px-2 py-0.5 rounded text-green-700 bg-green-100">Goed</span>
                                    @elseif($k->bkr_check === 'Afgekeurd!')
                                        <span class="inline-block px-2 py-0.5 rounded text-red-700 bg-red-100">Afgekeurd</span>
                                    @else
                                        <span class="inline-block px-2 py-0.5 rounded text-gray-700 bg-gray-100">Nog niet</span>
                                    @endif
                                </td>

                                <!-- allow wrapping for opmerkingen so horizontal scroll not needed -->
                                <td class="px-3 py-2 text-gray-700 whitespace-normal break-words max-w-xs">
                                    {{ Str::limit($k->opmerkingen, 200) }}
                                </td>

                                <td class="px-3 py-2">
                                    <a href="{{ route('createContract', $k->klant_id) }}" class="text-blue-600 hover:underline text-sm">Kies producten</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-3 py-6 text-center text-gray-500">Geen klanten gevonden.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

