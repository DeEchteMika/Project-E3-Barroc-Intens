<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klant;


class FinancienController extends Controller
{
    // Controller methods for financial management will go here
    public function index()
    {

        $klanten = Klant::orderBy('date', 'desc')->paginate(15);
    return view('financien.index', compact('klanten'));
    }

    public function create()
    {
        return view('financien.create');
    }

    public function store(Request $request)
    {
        // Logic to store financial data
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
