<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(to right, #3B82F6, #2563EB);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .content {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .info-box {
            background: white;
            border-left: 4px solid #3B82F6;
            padding: 15px;
            margin: 10px 0;
        }
        .info-label {
            font-weight: bold;
            color: #1F2937;
        }
        .footer {
            text-align: center;
            color: #6B7280;
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Monteur Toegewezen</h1>
        <p style="margin: 5px 0 0 0;">Barroc Intens Onderhoud</p>
    </div>

    <div class="content">
        <p>Beste {{ $klant->contactpersoon }},</p>

        <p>Er is een monteur toegewezen aan uw geplande onderhoud.</p>

        <div class="info-box">
            <p class="info-label">Monteur:</p>
            <p>{{ $monteur->voornaam }} {{ $monteur->achternaam }}</p>
            <p>{{ $monteur->email }} | {{ $monteur->telefoon }}</p>
        </div>

        <div class="info-box">
            <p class="info-label">Onderhoud Gepland:</p>
            <p>{{ $onderhoud->volgende_onderhoud->format('d-m-Y H:i') }}</p>
        </div>

        <div class="info-box">
            <p class="info-label">Onderhoudsinterval:</p>
            <p>{{ $onderhoud->interval_label }}</p>
        </div>

        @if($onderhoud->contract)
        <div class="info-box">
            <p class="info-label">Contract:</p>
            <p>{{ $onderhoud->contract->contractnummer }}</p>
        </div>
        @endif

        @if($onderhoud->opmerkingen)
        <div class="info-box">
            <p class="info-label">Opmerkingen:</p>
            <p>{{ $onderhoud->opmerkingen }}</p>
        </div>
        @endif

        <p>De monteur zal op de geplande datum bij u langskomen voor het onderhoud.</p>

        <p>Met vriendelijke groet,<br>
        Barroc Intens</p>
    </div>

    <div class="footer">
        <p>Dit is een geautomatiseerd bericht. U kunt niet rechtstreeks op deze e-mail reageren.</p>
    </div>
</body>
</html>
