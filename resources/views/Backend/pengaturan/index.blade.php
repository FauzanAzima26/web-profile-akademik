@extends('layouts.backend')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Pengaturan Aplikasi</h5>
        </div>
        <div class="card-body">
            {{-- Pesan sukses/error --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Form update pengaturan --}}
            <form action="{{ route('backend.pengaturan.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_aplikasi" class="form-label">Nama Aplikasi</label>
                    <input type="text" 
                           name="nama_aplikasi" 
                           id="nama_aplikasi" 
                           class="form-control @error('nama_aplikasi') is-invalid @enderror" 
                           value="{{ old('nama_aplikasi', $pengaturan->nama_aplikasi ?? '') }}" 
                           required>
                    @error('nama_aplikasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $pengaturan->email ?? '') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" 
                           name="telepon" 
                           id="telepon" 
                           class="form-control @error('telepon') is-invalid @enderror" 
                           value="{{ old('telepon', $pengaturan->telepon ?? '') }}">
                    @error('telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" 
                              id="alamat" 
                              rows="3" 
                              class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $pengaturan->alamat ?? '') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
