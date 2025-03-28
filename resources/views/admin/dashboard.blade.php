@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4>Dashboard Admin</h4>
            </div>
            <div class="card-body">
                <h5>Selamat Datang di Panel Admin Sistem Reservasi Klinik</h5>
                <p>Dari panel ini, Anda dapat mengelola dokter dan reservasi pasien.</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Dokter</h5>
                        <h2 class="mb-0">{{ \App\Models\Dokter::count() }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-user-md fa-3x"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.dokter.index') }}" class="text-white">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Reservasi</h5>
                        <h2 class="mb-0">{{ \App\Models\Reservasi::count() }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-calendar-check fa-3x"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.reservasi.index') }}" class="text-white">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Reservasi Pending</h5>
                        <h2 class="mb-0">{{ \App\Models\Reservasi::where('status', 'pending')->count() }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-clock fa-3x"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.reservasi.index') }}" class="text-white">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Total Pasien</h5>
                        <h2 class="mb-0">{{ \App\Models\Pasien::count() }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Reservasi Terbaru</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Reservasi::with(['pasien', 'dokter'])->orderBy('created_at', 'desc')->take(5)->get() as $reservasi)
                            <tr>
                                <td>{{ $reservasi->pasien->nama }}</td>
                                <td>{{ $reservasi->dokter->nama }}</td>
                                <td>{{ date('d-m-Y', strtotime($reservasi->tanggal)) }} {{ date('H:i', strtotime($reservasi->jam)) }}</td>
                                <td>
                                    @if($reservasi->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($reservasi->status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.reservasi.show', $reservasi->id) }}" class="btn btn-sm btn-info">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection