@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Daftar Reservasi</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Spesialisasi</th>
                        <th>Tanggal & Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservasis as $key => $reservasi)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reservasi->pasien->nama }}</td>
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
                                <a href="{{ route('admin.reservasi.show', $reservasi->id) }}" class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data reservasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection