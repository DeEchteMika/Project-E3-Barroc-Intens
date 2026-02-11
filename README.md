# Project-E3-Barroc-Intens
Project E3

1. Clone het project

2. Environment instellen
cp .env.example .env

3. Dependencies installeren
composer install
npm install

4. Laravel configureren
php artisan key:generate
php artisan migrate:fresh --seed

5. Frontend bouwen
npm run dev

6. inloggen op de site
Email: management@example.com
wachtwoord: password


Acceptatietest:

Situatie
Test – Klant toevoegen en terugzien in overzicht
Gebruikerssituatie
De ingelogde gebruiker wil een nieuwe klant toevoegen en dit terugzien in het overzicht.
Stappen
1.	Zorg dat je bent ingelogd.
2.  Navigeren naar de salespagina.
3.	Klik op "Nieuwe klant toevoegen".
4.	Vul alle verplichte velden in (bijvoorbeeld naam en beschrijving).
5.	Klik op "Opslaan".
Verwacht resultaat
•	De gebruiker krijgt een melding dat de klant succesvol is opgeslagen.
•	De nieuwe klant is zichtbaar in het overzicht.
•	De ingevoerde gegevens worden correct weergegeven.


