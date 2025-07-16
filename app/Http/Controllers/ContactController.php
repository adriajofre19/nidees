<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Contact/Index');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        Mail::to('adria.ordis@gmail.com')->send(new ContactMail($validated));

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
