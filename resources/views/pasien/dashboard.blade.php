@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4>Dashboard Pasien</h4>
            </div>
            <div class="card-body">
                <h5>Selamat Datang, {{ Auth::guard('pasien')->user()->nama }}!</h5>
                <p>Dari panel ini, Anda dapat melihat dan mengelola reservasi klinik Anda.</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Reservasi Aktif</h5>
                        <h2 class="mb-0">{{ \App\Models\Reservasi::where('id_pasien', Auth::guard('pasien')->id())->whereIn('status', ['pending', 'approved'])->count() }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-calendar-check fa-3x"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('reservasi.index') }}" class="text-white">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title">Reservasi yang Disetujui</h5>
                        <h2 class="mb-0">{{ \App\Models\Reservasi::where('id_pasien', Auth::guard('pasien')->id())->where('status', 'approved')->count() }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-check-circle fa-3x"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('reservasi.index') }}" class="text-white">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Reservasi Terbaru</h4>
                <a href="{{ route('reservasi.create') }}" class="btn btn-primary">Buat Reservasi Baru</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Dokter</th>
                                <th>Spesialisasi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Reservasi::with('dokter')->where('id_pasien', Auth::guard('pasien')->id())->orderBy('created_at', 'desc')->take(5)->get() as $reservasi)
                            <tr>
                                <td>{{ $reservasi->dokter->nama }}</td>
                                <td>{{ $reservasi->dokter->spesialisasi }}</td>
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
                                    <a href="{{ route('reservasi.show', $reservasi->id) }}" class="btn btn-sm btn-info">Detail</a>
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