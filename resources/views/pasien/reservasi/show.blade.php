@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Detail Reservasi</h4>
        <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Dokter:</div>
            <div class="col-md-9">{{ $reservasi->dokter->nama }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Spesialisasi:</div>
            <div class="col-md-9">{{ $reservasi->dokter->spesialisasi }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Tanggal:</div>
            <div class="col-md-9">{{ date('d-m-Y', strtotime($reservasi->tanggal)) }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Jam:</div>
            <div class="col-md-9">{{ date('H:i', strtotime($reservasi->jam)) }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Status:</div>
            <div class="col-md-9">
                @if($reservasi->status == 'pending')
                    <span class="badge bg-warning">Pending</span>
                @elseif($reservasi->status == 'approved')
                    <span class="badge bg-success">Disetujui</span>
                @else
                    <span class="badge bg-danger">Dibatalkan</span>
                @endif
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Keluhan:</div>
            <div class="col-md-9">{{ $reservasi->keluhan ?? '-' }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Tanggal Dibuat:</div>
            <div class="col-md-9">{{ date('d-m-Y H:i', strtotime($reservasi->created_at)) }}</div>
        </div>
        
        @if($reservasi->status == 'pending')
            <div class="row mt-4">
                <div class="col-md-12">
                    <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="btn btn-warning">Edit Reservasi</a>
                    
                    <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?')">Batalkan Reservasi</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection