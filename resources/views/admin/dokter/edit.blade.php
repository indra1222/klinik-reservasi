@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Dokter</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group row mb-3">
                <label for="nama" class="col-md-3 col-form-label text-md-right">Nama Dokter</label>
                <div class="col-md-7">
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" required value="{{ old('nama', $dokter->nama) }}">
                    
                    @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-3">
                <label for="spesialisasi" class="col-md-3 col-form-label text-md-right">Spesialisasi</label>
                <div class="col-md-7">
                    <input type="text" name="spesialisasi" id="spesialisasi" class="form-control @error('spesialisasi') is-invalid @enderror" required value="{{ old('spesialisasi', $dokter->spesialisasi) }}">
                    
                    @error('spesialisasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-0">
                <div class="col-md-7 offset-md-3">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection