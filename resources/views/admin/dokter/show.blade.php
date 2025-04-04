@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Detail Dokter</h4>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Nama Dokter:</div>
            <div class="col-md-9">{{ $dokter->nama }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Spesialisasi:</div>
            <div class="col-md-9">{{ $dokter->spesialisasi }}</div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-3 font-weight-bold">Tanggal Terdaftar:</div>
            <div class="col-md-9">{{ $dokter->created_at->format('d-m-Y H:i') }}</div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12">
                <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-warning">Edit Dokter</a>
                
                <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dokter ini?')">Hapus Dokter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h4>Reservasi Terkait</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dokter->reservasi()->with('pasien')->orderBy('tanggal', 'desc')->get() as $key => $reservasi)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reservasi->pasien->nama }}</td>
                            <td>{{ date('d-m-Y', strtotime($reservasi->tanggal)) }}</td>
                            <td>{{ date('H:i', strtotime($reservasi->jam)) }}</td>
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
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada reservasi untuk dokter ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection