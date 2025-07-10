@extends('layouts.template_default')
@section('title', 'Jadwal Eskul')
@section('jadwal', 'active')

@section('content')
<div class="content-wrapper">
    @include('sweetalert::alert')

    <section class="content-header">
        <div class="container-fluid">
            <h5 class="text-center font-weight-bold mb-3">Jadwal Ekstrakurikuler Saya</h5>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @forelse($eskuls as $eskul)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100 border-0">
                        <div class="card-body text-center">
                            <img src="{{ $eskul->logo ? Storage::url($eskul->logo) : asset('assets/img/default.png') }}"
                                class="img-fluid rounded mb-2" width="60">
                            <h6 class="font-weight-bold">{{ $eskul->nama_eskul }}</h6>
                            <p class="text-muted mb-2">{{ $eskul->tahun_ajaran }}</p>
                            <a href="{{ route('siswa.jadwal.show', $eskul->id) }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-calendar"></i> Lihat Jadwal
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada Eskul yang disetujui.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
