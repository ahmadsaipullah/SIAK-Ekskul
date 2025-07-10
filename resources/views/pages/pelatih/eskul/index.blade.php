@extends('layouts.template_default')
@section('title', 'eskul')
@section('pelatih_eskul', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <h5 class="font-weight-bold">Ekstrakurikuler yang Diasuh</h5>
    </section>
 @include('sweetalert::alert')
    <section class="content mt-2">
        <div class="container-fluid">
            @if($eskuls->count())
                <div class="row">
                    @foreach($eskuls as $e)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">

                                <!-- Logo Eskul -->
                                @if($e->logo)
                                    <img src="{{ Storage::url($e->logo) }}" alt="Logo Eskul"
                                        class="rounded-circle shadow-sm mb-2"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-circle mb-2"
                                         style="width: 80px; height: 80px; line-height: 80px;">
                                        <i class="fa fa-image text-muted"></i>
                                    </div>
                                @endif

                                <!-- Info Eskul -->
                                <h6 class="font-weight-bold mb-1">{{ $e->nama_eskul }}</h6>
                                <p class="text-muted mb-2">{{ $e->tahun_ajaran }}</p>

                                <!-- Tombol -->
                                <a href="{{ route('pelatih.eskul.siswa', $e->id) }}" class="btn btn-sm btn-primary">
                                    Kelola Siswa
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info text-center">Belum ada ekstrakurikuler dengan pendaftaran siswa.</div>
            @endif
        </div>
    </section>
</div>
@endsection
