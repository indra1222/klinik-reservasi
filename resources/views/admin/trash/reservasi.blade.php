@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Sampah Reservasi</h4>
        <a href="{{ route('admin.reservasi.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Tanggal & Waktu</th>
                        <th>Status</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservasis as $key => $reservasi)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reservasi->pasien->nama ?? 'Pasien tidak ditemukan' }}</td>
                            <td>{{ $reservasi->dokter->nama ?? 'Dokter tidak ditemukan' }}</td>
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
                            <td>{{ $reservasi->deleted_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.trash.reservasi.restore', $reservasi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Pulihkan</button>
                                </form>
                                
                                <form action="{{ route('admin.trash.reservasi.force-delete', $reservasi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus reservasi ini secara permanen?')">Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data reservasi yang terhapus</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection