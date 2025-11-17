<?php

namespace App\Enums;

enum RoleEnum: int
{
    case ADMIN = 10;
    case SALES = 5;
    case FINANCIEN = 7;
    case ONDERHOUD = 4;
    case INKOOP = 6;
    case KLANTENSERVICE = 3;
    case MANAGEMENT = 8;

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::SALES => 'Sales',
            self::FINANCIEN => 'Financiën',
            self::ONDERHOUD => 'Onderhoud',
            self::INKOOP => 'Inkoop',
            self::KLANTENSERVICE => 'Klantenservice',
            self::MANAGEMENT => 'Management',
        };
    }

    public function displayText(): string
    {
        return match($this) {
            self::INKOOP => 'Inkoop',
            self::KLANTENSERVICE => 'Klantenservice',
            default => '',
        };
    }
}
