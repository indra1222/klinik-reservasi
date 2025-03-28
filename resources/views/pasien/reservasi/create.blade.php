@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Buat Reservasi Baru</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('reservasi.store') }}" method="POST">
            @csrf
            
            <div class="form-group row mb-3">
                <label for="id_dokter" class="col-md-4 col-form-label text-md-right">Pilih Dokter</label>
                <div class="col-md-6">
                    <select name="id_dokter" id="id_dokter" class="form-control @error('id_dokter') is-invalid @enderror" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->id }}" {{ (old('id_dokter') == $dokter->id || request('dokter_id') == $dokter->id) ? 'selected' : '' }}>
                                {{ $dokter->nama }} - {{ $dokter->spesialisasi }}
                            </option>
                        @endforeach
                    </select>
                    
                    @error('id_dokter')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-3">
                <label for="tanggal" class="col-md-4 col-form-label text-md-right">Tanggal Kunjungan</label>
                <div class="col-md-6">
                    <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" required value="{{ old('tanggal', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
                    
                    @error('tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-3">
                <label for="jam" class="col-md-4 col-form-label text-md-right">Jam Kunjungan</label>
                <div class="col-md-6">
                    <select name="jam" id="jam" class="form-control @error('jam') is-invalid @enderror" required>
                        <option value="">-- Pilih Jam --</option>
                        <option value="08:00" {{ old('jam') == '08:00' ? 'selected' : '' }}>08:00</option>
                        <option value="09:00" {{ old('jam') == '09:00' ? 'selected' : '' }}>09:00</option>
                        <option value="10:00" {{ old('jam') == '10:00' ? 'selected' : '' }}>10:00</option>
                        <option value="11:00" {{ old('jam') == '11:00' ? 'selected' : '' }}>11:00</option>
                        <option value="13:00" {{ old('jam') == '13:00' ? 'selected' : '' }}>13:00</option>
                        <option value="14:00" {{ old('jam') == '14:00' ? 'selected' : '' }}>14:00</option>
                        <option value="15:00" {{ old('jam') == '15:00' ? 'selected' : '' }}>15:00</option>
                        <option value="16:00" {{ old('jam') == '16:00' ? 'selected' : '' }}>16:00</option>
                    </select>
                    
                    @error('jam')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-3">
                <label for="keluhan" class="col-md-4 col-form-label text-md-right">Keluhan</label>
                <div class="col-md-6">
                    <textarea name="keluhan" id="keluhan" rows="4" class="form-control @error('keluhan') is-invalid @enderror">{{ old('keluhan') }}</textarea>
                    
                    @error('keluhan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Buat Reservasi
                    </button>
                    <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection