<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PrivacyController extends Controller
{
    public function index()
    {
        return Inertia::render('PrivacyPolicy');
    }

    public function cookies()
    {
        return Inertia::render('CookiesPrivacy');
    }

    public function legal()
    {
        return Inertia::render('LegalWarning');
    }

    public function terms()
    {
        return Inertia::render('TermsAndConditions');
    }
}
