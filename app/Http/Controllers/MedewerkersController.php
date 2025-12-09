<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Medewerker;
use App\Models\Rechten;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MedewerkersController extends Controller
{
    /**
     * Ensure only admin or management can access medewerker management.
     */
    private function authorizeAdminOrManagement(): void
    {
        $user = auth()->user();

        if (! $user || ! $user->medewerker || ! $user->medewerker->rechten) {
            abort(403);
        }

        $rechten = $user->medewerker->rechten;
        $niveau = intval($rechten->toegangsniveau ?? 0);
        $rol = strtolower($rechten->rol ?? '');

        $isAllowedRole = in_array($rol, ['administrator', 'admin', 'management'], true);
        $isAllowedLevel = $niveau >= RoleEnum::MANAGEMENT->value;

        if (! $isAllowedRole && ! $isAllowedLevel) {
            abort(403);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorizeAdminOrManagement();

        $medewerkers = Medewerker::with(['afdeling', 'rechten', 'user'])
            ->orderBy('achternaam')
            ->orderBy('voornaam')
            ->get();

        return view('admin.index', [
            'medewerkers' => $medewerkers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorizeAdminOrManagement();

        $rechten = Rechten::orderBy('toegangsniveau', 'desc')->orderBy('rol')->get();

        return view('admin.create', [
            'rechten' => $rechten,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeAdminOrManagement();

        $data = $request->validate([
            'voornaam' => ['required', 'string', 'max:100'],
            'achternaam' => ['required', 'string', 'max:100'],
            'functie' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'telefoon' => ['nullable', 'string', 'max:50'],
            'rechten_id' => ['required', 'exists:rechten,rechten_id'],
            'actief' => ['nullable', 'boolean'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $actief = array_key_exists('actief', $data) ? (bool) $data['actief'] : true;

        DB::transaction(function () use ($data, $actief) {
            $user = User::create([
                'name' => trim($data['voornaam'] . ' ' . $data['achternaam']),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            Medewerker::create([
                'voornaam' => $data['voornaam'],
                'achternaam' => $data['achternaam'],
                'functie' => $data['functie'] ?? null,
                'email' => $data['email'],
                'telefoon' => $data['telefoon'] ?? null,
                'rechten_id' => $data['rechten_id'],
                'actief' => $actief,
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('admin')->with('status', 'Medewerker aangemaakt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorizeAdminOrManagement();

        $medewerker = Medewerker::with('user')->findOrFail($id);
        $rechten = Rechten::orderBy('toegangsniveau', 'desc')->orderBy('rol')->get();

        return view('admin.edit', [
            'medewerker' => $medewerker,
            'rechten' => $rechten,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorizeAdminOrManagement();

        $medewerker = Medewerker::with('user')->findOrFail($id);

        $data = $request->validate([
            'voornaam' => ['required', 'string', 'max:100'],
            'achternaam' => ['required', 'string', 'max:100'],
            'functie' => ['nullable', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')->ignore($medewerker->user_id),
            ],
            'telefoon' => ['nullable', 'string', 'max:50'],
            'rechten_id' => ['required', 'exists:rechten,rechten_id'],
            'actief' => ['nullable', 'boolean'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $actief = array_key_exists('actief', $data)
            ? (bool) $data['actief']
            : (bool) $medewerker->actief;

        DB::transaction(function () use ($data, $medewerker, $actief) {
            if ($medewerker->user) {
                $medewerker->user->update([
                    'name' => trim($data['voornaam'] . ' ' . $data['achternaam']),
                    'email' => $data['email'],
                    'password' => ($data['password'] ?? null)
                        ? Hash::make($data['password'])
                        : $medewerker->user->password,
                ]);
            }

            $medewerker->update([
                'voornaam' => $data['voornaam'],
                'achternaam' => $data['achternaam'],
                'functie' => $data['functie'] ?? null,
                'email' => $data['email'],
                'telefoon' => $data['telefoon'] ?? null,
                'rechten_id' => $data['rechten_id'],
                'actief' => $actief,
            ]);
        });

        return redirect()->route('admin')->with('status', 'Medewerker bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorizeAdminOrManagement();

        $medewerker = Medewerker::with('user')->findOrFail($id);

        DB::transaction(function () use ($medewerker) {
            if ($medewerker->user) {
                $medewerker->user->delete();
            }

            $medewerker->delete();
        });

        return redirect()->route('admin')->with('status', 'Medewerker verwijderd.');
    }
}
