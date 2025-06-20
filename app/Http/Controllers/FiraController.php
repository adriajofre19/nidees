<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Fire;
use Illuminate\Support\Str;

class FiraController extends Controller
{
    public function index(Request $request)
    {
        $fires = Fire::all(); 

        return Inertia::render('Nosotros', [
            'fires' => $fires,
        ]);
    }

    
}
