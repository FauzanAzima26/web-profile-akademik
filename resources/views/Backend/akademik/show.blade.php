@extends('layouts.backend')

@section('content')
<div class="container mt-4">
    <h2>Detail Akademik</h2>

    <div class="card p-3">
        <h4>{{ $akademik->judul }}</h4>
        <p>{!! nl2br(e($akademik->konten)) !!}</p>

        @if($akademik->file)
            <a href="{{ asset('storage/' . $akademik->file) }}" target="_blank" class="btn btn-outline-primary">
                Lihat File
            </a>
        @endif

        <div class="mt-3">
            <a href="{{ route('backend.akademik.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
