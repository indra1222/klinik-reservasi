<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function indexDokter()
    {
        $dokters = Dokter::onlyTrashed()->get();
        return view('admin.trash.dokter', compact('dokters'));
    }
    
    public function restoreDokter($id)
    {
        $dokter = Dokter::onlyTrashed()->findOrFail($id);
        $dokter->restore();
        
        return redirect()->route('admin.trash.dokter')
                         ->with('success', 'Dokter berhasil dipulihkan');
    }
    
    public function forceDeleteDokter($id)
    {
        $dokter = Dokter::onlyTrashed()->findOrFail($id);
        $dokter->forceDelete();
        
        return redirect()->route('admin.trash.dokter')
                         ->with('success', 'Dokter berhasil dihapus permanen');
    }
    
    public function indexReservasi()
    {
        $reservasis = Reservasi::with(['dokter', 'pasien'])->onlyTrashed()->get();
        return view('admin.trash.reservasi', compact('reservasis'));
    }
    
    public function restoreReservasi($id)
    {
        $reservasi = Reservasi::onlyTrashed()->findOrFail($id);
        $reservasi->restore();
        
        return redirect()->route('admin.trash.reservasi')
                         ->with('success', 'Reservasi berhasil dipulihkan');
    }
    
    public function forceDeleteReservasi($id)
    {
        $reservasi = Reservasi::onlyTrashed()->findOrFail($id);
        $reservasi->forceDelete();
        
        return redirect()->route('admin.trash.reservasi')
                         ->with('success', 'Reservasi berhasil dihapus permanen');
    }
}