<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $recipientEmail = SiteSetting::get('contact_email', config('mail.from.address'));

        try {
            Mail::to($recipientEmail)->send(new ContactMessage($validated));

            return back()->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer plus tard.')
                ->withInput();
        }
    }
}
