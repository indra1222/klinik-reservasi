<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $dokters = Dokter::all();
        return view('welcome', compact('dokters'));
    }
    
    public function cariJadwal(Request $request)
    {
        $request->validate([
            'spesialisasi' => 'nullable|string',
        ]);
        
        $query = Dokter::query();
        
        if ($request->filled('spesialisasi')) {
            $query->where('spesialisasi', 'like', '%' . $request->spesialisasi . '%');
        }
        
        $dokters = $query->get();
        
        return view('welcome', compact('dokters'));
    }
}