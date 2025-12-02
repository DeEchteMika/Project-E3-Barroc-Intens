@if(isset($klant) && $klant->bkr_check === 'Goed gekeurd!')
    <h3>Onderwerp: Bevestiging BCR-check - Goedgekeurd</h3>
    <p>Beste {{ $klant->contactpersoon ?? 'klant' }},</p>
    <p>We willen u informeren dat uw BCR-check succesvol is afgerond en goedgekeurd. Alle gegevens zijn gecontroleerd en voldoen aan de gestelde eisen. Mocht u nog vragen hebben, neem dan gerust contact met ons op.</p>
    <p>Met vriendelijke groet,<br>baroc intens<br>Hoofd Financiële Administratie</p>

@elseif(isset($klant) && $klant->bkr_check === 'Afgekeurd!')
    <h3>Onderwerp: Resultaat BCR-check - Afgekeurd</h3>
    <p>Beste {{ $klant->contactpersoon ?? 'klant' }},</p>
    <p>Na controle van uw BCR-check hebben wij geconstateerd dat deze niet voldoet aan de geldende criteria. Hieronder vindt u de specifieke punten van afkeuring:</p>
    <ul>
        <li>schulden</li>
    </ul>
    <p>Wij verzoeken u de benodigde aanpassingen door te voeren en de controle opnieuw in te dienen. Voor nadere toelichting kunt u contact met ons opnemen.</p>
    <p>Met vriendelijke groet,<br>baroc intens<br>Hoofd Financiële Administratie</p>

@else
    <p>Bij ontvangst van deze e-mail</p>
    <p>Met vriendelijke groet,<br>Het testteam</p>
@endif
