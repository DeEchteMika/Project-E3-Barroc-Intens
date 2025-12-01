@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Test: Stuur e-mail naar klant / test adres</h1>

    @if(session('status'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ url('/send-mail-test') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Klant ID (optioneel)</label>
            <input type="text" name="klant_id" class="mt-1 block w-full rounded border-gray-300" placeholder="123" />
            <div class="text-xs text-gray-500 mt-1">Als je een bestaande Klant-ID opgeeft en die klant heeft een e-mailadres, wordt de mail naar die klant gestuurd.</div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Test e-mail (optioneel)</label>
            <input type="email" name="test_email" class="mt-1 block w-full rounded border-gray-300" placeholder="jouw@example.com" />
            <div class="text-xs text-gray-500 mt-1">Vul een e-mailadres in om direct naar dat adres te sturen (overschrijft TEST_MAIL_RECIPIENT).</div>
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Stuur testmail</button>
        </div>
    </form>
</div>
@endsection
