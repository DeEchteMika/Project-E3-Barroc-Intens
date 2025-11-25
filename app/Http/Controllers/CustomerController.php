<?php

namespace App\Http\Controllers;

use App\Models\Klant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Klant::query()
            ->latest()
            ->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function create(): View
    {
        return view('customers.create');
    }


    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:200'],
            'contact_person' => ['nullable', 'string', 'max:200'],
            'email' => ['required', 'email:rfc,dns', 'max:150'],
            'phone' => ['nullable', 'string', 'max:50'],
            'street' => ['nullable', 'string', 'max:255'],
            'house_number' => ['nullable', 'string', 'max:20'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'city' => ['nullable', 'string', 'max:100'],
            'kvk_number' => ['nullable', 'string', 'max:100'],
            'vat_number' => ['nullable', 'string', 'max:100'],
            'credit_limit' => ['nullable', 'numeric', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        Klant::create([
            'klantnummer' => $this->generateCustomerNumber(),
            'bedrijfsnaam' => $data['company_name'],
            'contactpersoon' => $data['contact_person'] ?? null,
            'adres' => $this->composeAddress($data['street'] ?? null, $data['house_number'] ?? null),
            'postcode' => $data['postal_code'] ?? null,
            'plaats' => $data['city'] ?? null,
            'telefoon' => $data['phone'] ?? null,
            'email' => $data['email'],
            'opmerkingen' => $this->composeNotes($data),
        ]);

        return redirect()
            ->route('customers.index')
            ->with('status', __('Customer successfully created.'));
    }

    private function generateCustomerNumber(): string
    {
        return Str::upper('CUST-' . now()->format('ymdHis'));
    }

    private function composeAddress(?string $street, ?string $houseNumber): ?string
    {
        $parts = array_filter([$street, $houseNumber]);

        if (empty($parts)) {
            return null;
        }

        return implode(' ', $parts);
    }

    private function composeNotes(array $data): ?string
    {
        $lines = [];

        if (!empty($data['notes'])) {
            $lines[] = trim($data['notes']);
        }

        $meta = [
            'Status' => $data['status'] ?? null,
            'KvK' => $data['kvk_number'] ?? null,
            'VAT' => $data['vat_number'] ?? null,
            'Credit limit' => isset($data['credit_limit']) ? number_format((float) $data['credit_limit'], 2) : null,
        ];

        foreach ($meta as $label => $value) {
            if ($value !== null && $value !== '') {
                $lines[] = $label . ': ' . $value;
            }
        }

        return empty($lines) ? null : implode(PHP_EOL, $lines);
    }
}
