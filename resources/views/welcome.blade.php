<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>kut website werkt eindelijk als je dit ziet</h1>

    @auth
        @php
            $niveau = optional(optional(auth()->user()->medewerker)->rechten)->toegangsniveau ?? 0;
        @endphp

        <div style="background:#f6f6f6;padding:8px;margin:8px 0;border:1px solid #ddd;">
            <strong>Debug:</strong>
            <div>Email: {{ auth()->user()->email }}</div>
            <div>Medewerker ID: {{ optional(auth()->user()->medewerker)->medewerker_id ?? 'n.v.t.' }}</div>
            <div>Rol functie: {{ optional(auth()->user()->medewerker)->functie ?? 'n.v.t.' }}</div>
            <div>Toegangsniveau: {{ $niveau }}</div>
        </div>

        @if($niveau == 4)
            <p>Inkoop</p>
        @elseif($niveau == 3)
            <p>Klantenservice</p>
        @endif
    @endauth

    @guest
        <p>Je bent niet ingelogd.</p>
    @endguest
</body>
</html>
