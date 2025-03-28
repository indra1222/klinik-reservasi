@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Daftar Reservasi Saya</h4>
        <a href="{{ route('reservasi.create') }}" class="btn btn-primary">Buat Reservasi Baru</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dokter</th>
                        <th>Spesialisasi</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservasis as $key => $reservasi)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reservasi->dokter->nama }}</td>
                            <td>{{ $reservasi->dokter->spesialisasi }}</td>
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
                                <a href="{{ route('reservasi.show', $reservasi->id) }}" class="btn btn-sm btn-info">Detail</a>
                                
                                @if($reservasi->status == 'pending')
                                    <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    
                                    <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?')">Batalkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada reservasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection