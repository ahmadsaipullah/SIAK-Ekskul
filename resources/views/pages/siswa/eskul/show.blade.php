@extends('layouts.template_default')
@section('title', 'Detail Ekstrakurikuler')
@section('eskul', 'active')

@section('content')
<div class="content-wrapper">
    @include('sweetalert::alert')

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h5 class="text-center font-weight-bold mb-3">Detail Ekstrakurikuler</h5>
        </div>
    </section>

    <!-- Content -->
    <section class="content">
        <div class="container">
            <div class="card mx-auto shadow-lg border-0 rounded" style="max-width: 600px;">
                <div class="card-body text-center p-4">

                    <!-- Logo Eskul -->
                    <img src="{{ Storage::url($eskul->logo) }}" alt="Logo Eskul"
                         class="rounded-circle shadow mb-3"
                         style="width: 100px; height: 100px; object-fit: cover;">

                    <!-- Nama dan Tahun -->
                    <h5 class="font-weight-bold">{{ $eskul->nama_eskul }}</h5>
                    <p class="text-muted">{{ $eskul->tahun_ajaran }}</p>

                    <!-- Detail Info -->
                    <div class="text-left mt-4">
                        <p><strong>👤 Pelatih:</strong> {{ $eskul->pelatih->name ?? '-' }}</p>
                        <p><strong>📞 No HP:</strong> {{ $eskul->no_hp ?? '-' }}</p>
                        <p><strong>📆 Jumlah Pertemuan:</strong> {{ $eskul->jumlah_pertemuan }}</p>
                        <hr>
                        <p><strong>📋 Deskripsi:</strong></p>
                        <p class="text-justify">{{ $eskul->deskripsi }}</p>
                    </div>

                    <!-- Aksi Tombol -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('siswa.eskul.index') }}" class="btn btn-secondary btn-xs">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>

                        @php
                            $pendaftaran = auth()->user()
                                ->pendaftaranEskul()
                                ->where('eskul_id', $eskul->id)
                                ->first();
                        @endphp

                        @if(!$pendaftaran)
                            <form action="{{ route('siswa.eskul.daftar', $eskul->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-xs">
                                    <i class="fa fa-plus"></i> Daftar Eskul Ini
                                </button>
                            </form>
                        @elseif($pendaftaran->status == 'Ditolak')
                            <form action="{{ route('siswa.eskul.daftar', $eskul->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-xs">
                                    <i class="fa fa-refresh"></i> Ganti Eskul
                                </button>
                            </form>
                        @else
                            <span class="badge bg-warning px-3 py-2">
                                Status: {{ $pendaftaran->status }}
                            </span>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
