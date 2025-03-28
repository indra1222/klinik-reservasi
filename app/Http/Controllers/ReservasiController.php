<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pasien');
    }
    
    public function index()
    {
        $reservasis = Reservasi::with('dokter')
                    ->where('id_pasien', Auth::guard('pasien')->id())
                    ->orderBy('tanggal', 'desc')
                    ->get();
                    
        return view('pasien.reservasi.index', compact('reservasis'));
    }
    
    public function create()
    {
        $dokters = Dokter::all();
        return view('pasien.reservasi.create', compact('dokters'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:dokter,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required',
            'keluhan' => 'nullable|string',
        ]);
        
        Reservasi::create([
            'id_dokter' => $request->id_dokter,
            'id_pasien' => Auth::guard('pasien')->id(),
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'status' => 'pending',
            'keluhan' => $request->keluhan,
        ]);
        
        return redirect()->route('reservasi.index')
                        ->with('success', 'Reservasi berhasil dibuat');
    }
    
    public function show(Reservasi $reservasi)
    {
        // Check authorization
        if ($reservasi->id_pasien != Auth::guard('pasien')->id()) {
            abort(403);
        }
        
        return view('pasien.reservasi.show', compact('reservasi'));
    }
    
    public function edit(Reservasi $reservasi)
    {
        // Check authorization
        if ($reservasi->id_pasien != Auth::guard('pasien')->id()) {
            abort(403);
        }
        
        if ($reservasi->status != 'pending') {
            return redirect()->route('reservasi.index')
                            ->with('error', 'Hanya reservasi dengan status pending yang dapat diubah');
        }
        
        $dokters = Dokter::all();
        return view('pasien.reservasi.edit', compact('reservasi', 'dokters'));
    }
    
    public function update(Request $request, Reservasi $reservasi)
    {
        // Check authorization
        if ($reservasi->id_pasien != Auth::guard('pasien')->id()) {
            abort(403);
        }
        
        if ($reservasi->status != 'pending') {
            return redirect()->route('reservasi.index')
                            ->with('error', 'Hanya reservasi dengan status pending yang dapat diubah');
        }
        
        $request->validate([
            'id_dokter' => 'required|exists:dokter,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required',
            'keluhan' => 'nullable|string',
        ]);
        
        $reservasi->update([
            'id_dokter' => $request->id_dokter,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'keluhan' => $request->keluhan,
        ]);
        
        return redirect()->route('reservasi.index')
                        ->with('success', 'Reservasi berhasil diupdate');
    }
    
    public function destroy(Reservasi $reservasi)
    {
        // Check authorization
        if ($reservasi->id_pasien != Auth::guard('pasien')->id()) {
            abort(403);
        }
        
        if ($reservasi->status != 'pending') {
            return redirect()->route('reservasi.index')
                            ->with('error', 'Hanya reservasi dengan status pending yang dapat dibatalkan');
        }
        
        $reservasi->update(['status' => 'cancelled']);
        
        return redirect()->route('reservasi.index')
                        ->with('success', 'Reservasi berhasil dibatalkan');
    }
}