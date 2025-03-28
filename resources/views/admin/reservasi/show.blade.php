@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Detail Reservasi</h4>
        <a href="{{ route('admin.reservasi.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Pasien:</div>
            <div class="col-md-9">{{ $reservasi->pasien->nama }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Kontak Pasien:</div>
            <div class="col-md-9">{{ $reservasi->pasien->kontak }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Email Pasien:</div>
            <div class="col-md-9">{{ $reservasi->pasien->email }}</div>
        </div>
        
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
                <form action="{{ route('admin.reservasi.status.update', $reservasi->id) }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    @method('PATCH')
                    
                    <select name="status" class="form-control me-2" style="width: 150px;">
                        <option value="pending" {{ $reservasi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $reservasi->status == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="cancelled" {{ $reservasi->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
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
    </div>
</div>
@endsection