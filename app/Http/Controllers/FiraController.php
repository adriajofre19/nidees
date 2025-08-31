<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Fire;
use App\Models\Number;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FiraController extends Controller
{
    public function index(Request $request)
    {
        $fires = Fire::all(); 
        $numbers = Number::all();

        return Inertia::render('Nosotros', [
            'fires' => $fires,
            'numbers' => $numbers,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'horario' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        

        // Crear el registro de Fira
        $fire = Fire::create([
            'name' => $request->name,
            'horario' => $request->horario,
            'location' => $request->location,
        ]);

        // Guardar imagen si existe
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/fires'), $imageName);
            $fire->image = 'images/fires/' . $imageName;
            $fire->save();
        }

        return redirect()->route('nosotros.index');
    }

    public function destroy(Fire $fire)
    {
        // Eliminar la imagen del almacenamiento si existe
        if ($fire->image) {
            Storage::disk('public')->delete($fire->image);
        }

        // Eliminar el registro de Fira
        $fire->delete();

        return redirect()->route('nosotros.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'bags' => 'required|numeric',
            'second_life' => 'required|numeric',
        ]);

        $number = Number::first();
        $number->update([
            'bags' => $request->bags,
            'second_life' => $request->second_life,
        ]);

        return redirect()->route('nosotros.index');
    }
    

    
}
