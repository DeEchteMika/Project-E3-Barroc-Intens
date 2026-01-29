# Onderhoudschema Systeem - Implementatiehandleiding

## Overzicht

Dit systeem biedt een volledige oplossing voor het beheren van onderhoudswerkzaamheden met automatische meldingen wanneer onderhoud binnenkort vervalt.

## Nieuwe Functies

### 1. **Onderhoudschema Beheer**
- Maak onderhoudsschema's aan voor contracts
- Kies uit 3 onderhoudsintervallen:
  - 1 maand (30 dagen)
  - 6 maanden (180 dagen)
  - 1 jaar (365 dagen)

### 2. **Dashboard**
- **Realtime Overzicht**: Zie hoeveel onderhoud binnenkort vervalt en hoeveel achterstallig is
- **Twee Tabbladen**:
  - **Binnenkort Vervallen**: Onderhoud dat in de komende 3 dagen vervalt
  - **Achterstallig**: Onderhoud waarvan de vervaldatum is gepasseerd

### 3. **Automatische Notificaties**
- Dagelijks script dat automatisch notificaties genereert
- Notificaties worden gegenereerd 3 dagen voordat onderhoud vervalt
- Alle medewerkers ontvangen notificaties

### 4. **Klantoverzicht per Onderhoud**
- Zie alle onderhoudswerkzaamheden per klant
- Status indicatoren (✅ Op schema, 🟠 Binnenkort, 🔴 Achterstallig)

## Bestanden Toegevoegd

### Models
- `app/Models/OnderhoudSchema.php` - Model voor onderhoudschema's
- `app/Models/Notificatie.php` - Updated met onderhoud-relaties

### Services
- `app/Services/OnderhoudService.php` - Alle onderhoud-business logic

### Controllers
- `app/Http/Controllers/OnderhoudDashboardController.php` - Dashboard routes en logica

### Views
- `resources/views/onderhoud/dashboard.blade.php` - Hoofd dashboard
- `resources/views/onderhoud/list.blade.php` - Lijst van alle klanten met onderhoud
- `resources/views/onderhoud/create.blade.php` - Formulier voor nieuw onderhoudschema

### Database
- `database/migrations/0001_01_01_000090_create_onderhoud_schema_table.php` - Onderhoudschema tabel
- `database/migrations/0001_01_01_000095_add_onderhoud_columns_to_notificatie_table.php` - Notificatie uitbreidingen

### Console
- `app/Console/Commands/CheckMaintenanceDue.php` - Dagelijke taak voor notificaties

### Routes
- `/onderhoud/dashboard` - Hoofd dashboard
- `/onderhoud/create` - Formulier voor nieuw onderhoudschema
- `/onderhoud/list` - Volledige lijst van onderhouden
- `/onderhoud/{onderhoudSchema}/complete` - Onderhoud markeren als voltooid
- `/onderhoud/{onderhoudSchema}/deactivate` - Onderhoudschema deactiveren
- `/onderhoud/klant/{klant}` - Onderhouden per klant

## Installatie Stappen

### 1. Database Migraties Draaien
```bash
php artisan migrate
```

Dit zal twee nieuwe tabellen en kolommen aanmaken.

### 2. Scheduler Configureren (Optioneel)
Voor automatische notificaties elke dag om bepaalde tijd, voeg dit toe aan `routes/console.php`:

```php
use App\Console\Commands\CheckMaintenanceDue;
use Illuminate\Support\Facades\Schedule;

Schedule::command(CheckMaintenanceDue::class)->daily();
```

Of draai handmatig:
```bash
php artisan onderhoud:check-due
```

### 3. Routes Controleren
De routes zijn al toegevoegd aan `routes/web.php`.

## Gebruik

### Onderhoudschema Aanmaken
1. Ga naar `/onderhoud/dashboard`
2. Klik op "+ Nieuw Onderhoudschema"
3. Selecteer contract, klant en interval
4. Klik "Onderhoudschema Aanmaken"

### Dashboard Bekijken
- **`/onderhoud/dashboard`** toont samenvatting en twee tabbladen
- **Binnenkort Vervallen**: 3 tabel met onderhoud in de komende 3 dagen
- **Achterstallig**: Rood gemarkeerd onderhoud dat voorbij vervaldatum is

### Onderhoud Voltooien
1. Klik "Voltooid" in het dashboard of lijst
2. Automatisch berekent het systeem de volgende onderhouddatum
3. Volgende onderhoud = nu + interval dagen

### Alle Klanten Zien
Ga naar `/onderhoud/list` voor een volledige gegroepeerde overzicht per klant.

## Service Methoden (OnderhoudService)

```php
// Onderhoud in de komende X dagen
$daysForMaintenance = $service->getMaintenanceDueSoon($days = 3);

// Alle achterstallige onderhouden
$overdueMaintenance = $service->getOverdueMaintenance();

// Kombinatie van beide
$allDue = $service->getMaintenanceDueOrOverdue($days = 3);

// Nieuwe schema aanmaken
$schema = $service->createMaintenanceSchema($contractId, $klantId, $interval);

// Onderhoud voltooien en volgende inplannen
$service->completeMaintenanceAndScheduleNext($schemaId);

// Dashboard samenvatting
$summary = $service->getDashboardSummary();

// Per klant overzicht
$klantSchedule = $service->getCustomerMaintenanceSchedule($klantId);

// Deactiveren
$service->deactivateSchema($schemaId);
```

## Model Relaties

### OnderhoudSchema
```php
$schema->contract()      // Belongs to Contract
$schema->klant()         // Belongs to Klant
$schema->isDueSoon($days = 3)     // Check if due within X days
$schema->isOverdue()              // Check if overdue
$schema->daysUntilMaintenance()   // Days until maintenance
```

### Klant
```php
$klant->onderhoudSchemas()   // All maintenance schedules for customer
```

### Contract
```php
$contract->onderhoudSchemas()   // All maintenance schedules for contract
```

## Dashboard Features

### Samenvattingskaarten
- **Totaal Vervallen**: Alle onderhouden die vervallen of achterstallig zijn
- **Binnenkort Vervallen**: In de komende 3 dagen
- **Achterstallig**: Voorbij vervaldatum

### Interactieve Tabellen
- Sorteer op vervaldatum
- Klantinformatie direct zichtbaar
- Contactgegevens (telefoon/email) voor achterstallige items
- Snelle acties (Voltooid, Deactiveer)

## Notificaties

### Automatisch Gegenereerd
- Dagelijks wordt de `CheckMaintenanceDue` command uitgevoerd
- Voor elk onderhoud dat in 3 dagen vervalt, wordt een notificatie gegenereerd
- Alle medewerkers ontvangen de notificatie

### Notificatie Fields
- `type`: 'onderhoud_due_soon'
- `bericht_tekst`: Beschrijving met klant en datum
- `onderhoud_schema_id`: Link naar schema
- `klant_id`: Link naar klant
- `gelezen`: Boolean voor read status

## Status Indicatoren

| Status | Kleur | Betekenis |
|--------|-------|-----------|
| ✅ Op schema | Groen | Onderhoud is niet vervallen |
| 🟠 Binnenkort | Oranje | Vervalt in komende 3 dagen |
| 🔴 Achterstallig | Rood | Vervaldatum is voorbij |

## Tips & Best Practices

1. **Regelmatig dashboard checken** - Zorg dat niemand achterstallig onderhoud mist
2. **Notificaties inschakelen** - Zet de scheduler in voor automatische meldingen
3. **Interval kiezen** - Kies realistisch interval gebaseerd op contracttype
4. **Handtekeningen** - Voeg handtekeningen toe in `Onderhoud` model voor afronding
5. **Email notificaties** - Kunnen worden uitgebreid met mailable classes

## Mogelijke Uitbreidingen

1. Email notificaties naar klanten
2. SMS alerts voor achterstallige onderhouden
3. Herhalende taken (recurring maintenance)
4. Onderdelen tracking per onderhoud
5. Foto's/documenten bijlage
6. Handtekeningen digitaal
7. Export naar PDF/Excel
8. Google Calendar integratie
9. Mobile app dashboard

## Troubleshooting

**Migratie mislukt?**
```bash
php artisan migrate:rollback
php artisan migrate
```

**Notificaties worden niet gegenereerd?**
- Check of scheduler loopt: `php artisan tinker` → `Schedule::list()`
- Draai handmatig: `php artisan onderhoud:check-due`
- Check logs in `storage/logs/`

**Routes niet gevonden?**
```bash
php artisan route:clear
php artisan route:cache
```

---

**Created**: January 2026  
**System**: Laravel 11+  
**Database**: Relational (MySQL/PostgreSQL)
