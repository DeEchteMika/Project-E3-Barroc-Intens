<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function medewerker()
    {
        return $this->hasOne(\App\Models\Medewerker::class, 'user_id', 'id');
    }

    public function storings()
    {
        return $this->hasMany(Storing::class, 'monteur', 'id');
    }
    /**
     * Check if the user has at least the given toegangsniveau.
     *
     * This expects the user's `medewerker` relation to exist and that
     * `medewerker->rechten->toegangsniveau` contains the numeric level.
     */
    public function hasRight(int $level): bool
    {
        if (! $this->medewerker) {
            return false;
        }

        $rechten = $this->medewerker->rechten;

        if (! $rechten) {
            return false;
        }

        return intval($rechten->toegangsniveau) >= $level;
    }

    /**
     * Check if the user can access a named section (e.g. 'inkoop', 'sales').
     *
     * Rules:
     * - Management (rechten rol 'management' or toegangsniveau >= 8) can access everything.
     * - Otherwise the user can access the section only when their medewerker->afdeling->naam
     *   matches the section key (case-insensitive) or when their rechten->rol matches the section key.
     */
    public function canAccessSection(string $section): bool
    {
        if (! $this->medewerker) {
            return false;
        }

        $rechten = $this->medewerker->rechten;
        $afdeling = $this->medewerker->afdeling;

        // Management shortcut
        if ($rechten) {
            $rol = strtolower($rechten->rol ?? '');
            $niveau = intval($rechten->toegangsniveau ?? 0);
            if ($rol === 'management' || $niveau >= 8) {
                return true;
            }
        }

        $sectionKey = strtolower($section);

        // Match by rechten role
        if ($rechten && strtolower($rechten->rol ?? '') === $sectionKey) {
            return true;
        }

        // Match by afdeling name
        if ($afdeling && strtolower($afdeling->naam ?? '') === $sectionKey) {
            return true;
        }

        return false;
    }

}
