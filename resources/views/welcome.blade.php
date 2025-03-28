@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Selamat Datang di Klinik Sehat</h1>
    <p class="lead">Sistem reservasi online untuk memudahkan Anda membuat janji dengan dokter.</p>
    <hr class="my-4">
    <p>Silahkan login atau register untuk membuat reservasi.</p>
    @guest('pasien')
        <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a>
        <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">Register</a>
    @else
        <a class="btn btn-primary btn-lg" href="{{ route('reservasi.create') }}" role="button">Buat Reservasi</a>
    @endguest
</div>

<div class="row my-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Cari Jadwal Dokter</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('cari.jadwal') }}" method="GET">
                    <div class="form-group row">
                        <label for="spesialisasi" class="col-md-2 col-form-label">Spesialisasi:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" value="{{ request('spesialisasi') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Dokter</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dokter</th>
                                <th>Spesialisasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dokters as $key => $dokter)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $dokter->nama }}</td>
                                    <td>{{ $dokter->spesialisasi }}</td>
                                    <td>
                                        @auth('pasien')
                                            <a href="{{ route('reservasi.create', ['dokter_id' => $dokter->id]) }}" class="btn btn-sm btn-primary">Reservasi</a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-sm btn-info">Login untuk Reservasi</a>
                                        @endauth
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada dokter yang tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection