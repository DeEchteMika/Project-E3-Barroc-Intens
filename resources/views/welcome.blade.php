<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>website werkt eindelijk als je dit ziet</h1>

    @auth
        @php
            $niveau = optional(optional(auth()->user()->medewerker)->rechten)->toegangsniveau ?? 0;
            $roleEnum = \App\Enums\RoleEnum::tryFrom($niveau);
            $displayText = $roleEnum ? $roleEnum->displayText() : '';
        @endphp

        <div style="background:#f6f6f6;padding:8px;margin:8px 0;border:1px solid #ddd;">
            <strong>Debug:</strong>
            <div>Email: {{ auth()->user()->email }}</div>
            <div>Medewerker ID: {{ optional(auth()->user()->medewerker)->medewerker_id ?? 'n.v.t.' }}</div>
            <div>Rol functie: {{ optional(auth()->user()->medewerker)->functie ?? 'n.v.t.' }}</div>
            <div>Toegangsniveau: {{ $niveau }}</div>
        </div>
            <p>{{ $displayText }}</p>
    @endauth
    @guest
        <p>Je bent niet ingelogd.</p>
    @endguest
</body>
</html>
