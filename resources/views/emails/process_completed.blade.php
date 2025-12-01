@if(isset($klant) && $klant)
    <p>Beste {{ $klant->naam ?? 'klant' }},</p>
@else
    <p>Beste klant,</p>
@endif

<p>Dit is een test-e-mail om te bevestigen dat het proces is afgerond.</p>

<p>Met vriendelijke groet,<br>
Het testteam</p>
