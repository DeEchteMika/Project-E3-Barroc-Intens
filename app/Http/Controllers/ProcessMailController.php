<?php

namespace App\Http\Controllers;

use App\Mail\ProcessCompleted;
use App\Models\Klant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProcessMailController extends Controller
{
    public function showForm()
    {
        return view('send-mail');
    }

    public function send(Request $request)
    {
        // Default test recipient from environment for easier testing
        $testRecipient = env('TEST_MAIL_RECIPIENT', 'thijs@example.com');

        // If the form provides a test_email use that, otherwise fallback
        $email = $request->input('test_email') ?: $testRecipient;

        $klant = null;
        if ($request->filled('klant_id')) {
            $klant = Klant::find($request->input('klant_id'));
            if ($klant && !empty($klant->email)) {
                $email = $klant->email;
            }
        }

        Mail::to($email)->send(new ProcessCompleted($klant));

        return back()->with('status', 'Mail verzonden naar ' . $email);
    }
}
