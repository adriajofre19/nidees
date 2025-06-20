<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Fire;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FiraController extends Controller
{
    public function index(Request $request)
    {
        $fires = Fire::all(); 

        return Inertia::render('Nosotros', [
            'fires' => $fires,
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
            $path = $request->file('image')->store('fires', 'public');
            $fire->image = $path;
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
    

    
}
