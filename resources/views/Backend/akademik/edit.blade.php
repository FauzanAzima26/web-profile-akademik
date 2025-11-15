@extends('layouts.backend')

@section('title', 'Edit Akademik')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Akademik</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('backend.akademik.update', $akademik) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $akademik->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="konten" class="form-label">Konten <span class="text-danger">*</span></label>
                    <textarea name="konten" id="konten" rows="5" class="form-control @error('konten') is-invalid @enderror" required>{{ old('konten', $akademik->konten) }}</textarea>
                    @error('konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File (PDF, DOC, DOCX)</label>
                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf,.doc,.docx">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah file.
                        @if ($akademik->file)
                            <br>File saat ini: <a href="{{ Storage::url($akademik->file) }}" target="_blank">{{ basename($akademik->file) }}</a>
                        @endif
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('backend.akademik.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
