<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $reservasis = Reservasi::with(['dokter', 'pasien'])->orderBy('tanggal', 'desc')->get();
        return view('admin.reservasi.index', compact('reservasis'));
    }
    
    public function show(Reservasi $reservasi)
    {
        return view('admin.reservasi.show', compact('reservasi'));
    }
    
    public function updateStatus(Request $request, Reservasi $reservasi)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,cancelled',
        ]);
        
        $reservasi->update(['status' => $request->status]);
        
        return redirect()->route('admin.reservasi.index')
                        ->with('success', 'Status reservasi berhasil diupdate');
    }
}