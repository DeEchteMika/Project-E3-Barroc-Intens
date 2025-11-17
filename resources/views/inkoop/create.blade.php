@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nieuw product toevoegen</h1>

    <form action="{{ route('inkoop.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="productnummer">Productnummer</label>
            <input type="text" name="productnummer" id="productnummer" class="form-control" value="{{ old('productnummer') }}" required>
        </div>

        <div class="mb-3">
            <label for="naam">Naam</label>
            <input type="text" name="naam" id="naam" class="form-control" value="{{ old('naam') }}" required>
        </div>

        <div class="mb-3">
            <label for="omschrijving">Omschrijving</label>
            <textarea name="omschrijving" id="omschrijving" class="form-control">{{ old('omschrijving') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="prijs">Prijs</label>
            <input type="number" step="0.01" name="prijs" id="prijs" class="form-control" value="{{ old('prijs') }}">
        </div>

        <div class="mb-3">
            <label for="voorraad">Voorraad</label>
            <input type="number" name="voorraad" id="voorraad" class="form-control" value="{{ old('voorraad', 0) }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="heeft_maler" id="heeft_maler" class="form-check-input" value="1" {{ old('heeft_maler') ? 'checked' : '' }}>
            <label for="heeft_maler" class="form-check-label">Heeft maler</label>
        </div>

        <button class="btn btn-primary">Opslaan</button>
    </form>
</div>
@endsection
