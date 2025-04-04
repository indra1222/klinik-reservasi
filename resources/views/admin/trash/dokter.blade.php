@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Sampah Dokter</h4>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Spesialisasi</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dokters as $key => $dokter)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $dokter->nama }}</td>
                            <td>{{ $dokter->spesialisasi }}</td>
                            <td>{{ $dokter->deleted_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.trash.dokter.restore', $dokter->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Pulihkan</button>
                                </form>
                                
                                <form action="{{ route('admin.trash.dokter.force-delete', $dokter->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dokter ini secara permanen?')">Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data dokter yang terhapus</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection