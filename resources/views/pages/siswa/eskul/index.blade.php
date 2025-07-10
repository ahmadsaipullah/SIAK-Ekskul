@extends('layouts.template_default')
@section('title', 'eskul')
@section('eskul', 'active')

@section('content')
<div class="content-wrapper">
    @include('sweetalert::alert')

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <h5 class="text-center font-weight-bold mb-3">Pilih Ekstrakurikuler</h5>
        </div>
    </section>

    <!-- Content -->
    <section class="content">
        <div class="container-fluid">

            @php
                $user = auth()->user();
                $disetujuiCount = $user->pendaftaranEskul()->where('status', 'Disetujui')->count();
            @endphp

            @if($disetujuiCount >= 2)
                <div class="alert alert-warning text-sm text-center">
                    <i class="fa fa-exclamation-triangle"></i>
                    <strong>Perhatian:</strong> Kamu sudah mendaftar maksimal <b>2 ekstrakurikuler</b> yang disetujui.
                </div>
            @endif

            <div class="row">
                @foreach($eskuls as $eskul)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card shadow rounded border-0 h-100 hover-shadow transition">
                        <div class="card-body d-flex flex-column align-items-center justify-content-between">

                            <img src="{{ Storage::url($eskul->logo) }}"
                                alt="Logo Eskul"
                                class="rounded-circle shadow-sm mb-3"
                                style="width: 80px; height: 80px; object-fit: cover;">

                            <h6 class="font-weight-bold text-dark text-center mb-3">
                                {{ $eskul->nama_eskul }}
                            </h6>

                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <a href="{{ route('siswa.eskul.show', $eskul->id) }}"
                                    class="btn btn-info btn-xs">
                                    <i class="fa fa-eye"></i> Detail
                                </a>

                                @php
                                    $pendaftaran = $user->pendaftaranEskul()->where('eskul_id', $eskul->id)->first();
                                @endphp

                                @if(!$pendaftaran)
                                    @if($disetujuiCount < 2)
                                        <form action="{{ route('siswa.eskul.daftar', $eskul->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-xs">
                                                <i class="fa fa-plus"></i> Daftar
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-xs" disabled>
                                            Maks. 2 Eskul
                                        </button>
                                    @endif
                                @elseif($pendaftaran->status == 'Ditolak')
                                    @if($disetujuiCount < 2)
                                        <form action="{{ route('siswa.eskul.daftar', $eskul->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-xs">
                                                <i class="fa fa-refresh"></i> Ganti
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-xs" disabled>
                                            Maks. 2 Eskul
                                        </button>
                                    @endif
                                @elseif($pendaftaran->status == 'Disetujui')
                                    <span class="badge bg-secondary text-xs py-1 px-2">
                                        {{ $pendaftaran->status }}
                                    </span>
                                        @else
                                    <span class="badge bg-warning text-xs py-1 px-2">
                                        {{ $pendaftaran->status }}
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

{{-- Optional Custom Styling --}}
<style>
    .hover-shadow:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-3px);
        transition: 0.3s ease-in-out;
    }
</style>
@endsection
