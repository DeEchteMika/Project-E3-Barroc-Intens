<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .email-body {
            padding: 30px 20px;
        }
        .email-body h2 {
            color: #333;
            font-size: 20px;
            margin-top: 0;
        }
        .email-body p {
            margin: 15px 0;
            color: #555;
        }
        .reset-button {
            display: inline-block;
            padding: 14px 32px;
            margin: 20px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
            transition: transform 0.2s;
        }
        .reset-button:hover {
            transform: translateY(-2px);
        }
        .button-container {
            text-align: center;
            margin: 25px 0;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 5px 0;
            font-size: 14px;
        }
        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #e0e0e0;
        }
        .email-footer p {
            margin: 5px 0;
        }
        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 20px 0;
        }
        .warning-text {
            color: #e53e3e;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🔐 Wachtwoord Reset Aanvraag</h1>
        </div>
        
        <div class="email-body">
            <h2>Hallo{{ $userName ? ' ' . $userName : '' }},</h2>
            
            <p>U ontvangt deze e-mail omdat we een verzoek hebben ontvangen om het wachtwoord voor uw account te resetten.</p>
            
            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">
                    Wachtwoord Resetten
                </a>
            </div>
            
            <div class="info-box">
                <p><strong>⏰ Let op:</strong> Deze reset link is <strong>60 minuten</strong> geldig.</p>
                <p>Als u uw wachtwoord niet wilt resetten, hoeft u verder niets te doen.</p>
            </div>
            
            <div class="divider"></div>
            
            <p class="warning-text">⚠️ Belangrijk voor uw veiligheid:</p>
            <p style="font-size: 14px;">
                Als u deze wachtwoord reset niet heeft aangevraagd, neem dan onmiddellijk contact op met ons support team. 
                Dit kan betekenen dat iemand ongeautoriseerd toegang probeert te krijgen tot uw account.
            </p>
            
            <div class="divider"></div>
            
            <p style="font-size: 13px; color: #777;">
                <strong>Werkt de knop niet?</strong><br>
                Kopieer en plak de onderstaande link in uw browser:
            </p>
            <p style="font-size: 12px; color: #667eea; word-break: break-all;">
                {{ $resetUrl }}
            </p>
        </div>
        
        <div class="email-footer">
            <p><strong>Barroc Intens</strong></p>
            <p>Dit is een automatisch gegenereerde e-mail. Gelieve hier niet op te antwoorden.</p>
            <p>Voor vragen kunt u contact opnemen met onze support afdeling.</p>
            <p style="margin-top: 15px; color: #999;">
                © {{ date('Y') }} Barroc Intens. Alle rechten voorbehouden.
            </p>
        </div>
    </div>
</body>
</html>
