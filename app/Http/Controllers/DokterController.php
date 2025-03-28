<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $dokters = Dokter::all();
        return view('admin.dokter.index', compact('dokters'));
    }
    
    public function create()
    {
        return view('admin.dokter.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:255',
        ]);
        
        Dokter::create([
            'nama' => $request->nama,
            'spesialisasi' => $request->spesialisasi,
        ]);
        
        return redirect()->route('admin.dokter.index')
                        ->with('success', 'Dokter berhasil ditambahkan');
    }
    
    public function edit(Dokter $dokter)
    {
        return view('admin.dokter.edit', compact('dokter'));
    }
    
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:255',
        ]);
        
        $dokter->update([
            'nama' => $request->nama,
            'spesialisasi' => $request->spesialisasi,
        ]);
        
        return redirect()->route('admin.dokter.index')
                        ->with('success', 'Dokter berhasil diupdate');
    }
    
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        
        return redirect()->route('admin.dokter.index')
                        ->with('success', 'Dokter berhasil dihapus');
    }
}