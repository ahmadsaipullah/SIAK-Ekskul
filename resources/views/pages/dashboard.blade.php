@extends('layouts.template_default')
@section('title', 'SMK PGRI CIKUPA')
@section('dashboard', 'active')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    <h5 class="m-0">Selamat Datang, <span class="badge badge-success">{{ auth()->user()->name }}</span></h5>
                    <small>Di web sistem pusat informasi ekstrakurikuler <strong>SMKS PGRI CIKUPA</strong></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
<!-- SLIDER DINAMIS -->
@if($carousels->count() > 0)
<div id="carouselEskul" class="carousel slide mb-4" data-ride="carousel">
    <div class="carousel-inner rounded">

        @foreach ($carousels as $key => $carousel)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ Storage::url($carousel->image) }}" class="d-block w-100" alt="{{ $carousel->judul }}"
                     style="height: 300px; object-fit: cover;">

                <!-- Judul dan Deskripsi -->
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded p-2">
                    <h5 class="m-0">{{ $carousel->judul }}</h5>
                    <small>{{ $carousel->deskripsi }}</small>
                </div>
            </div>
        @endforeach

    </div>

    <!-- Navigasi -->
    <a class="carousel-control-prev" href="#carouselEskul" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" href="#carouselEskul" role="button" data-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
    </a>
</div>
@else
    <div class="alert alert-info text-center">Belum ada data carousel ekskul ditambahkan.</div>
@endif


            <!-- Menu Akses Siswa -->
            {{-- @if(auth()->user()->level_id != 1) --}}
            <div class="row text-center">
                <div class="col-6 col-md-3 mb-3">
                    <a href="#" class="btn btn-outline-primary w-100 py-3">
                        <i class="fas fa-users fa-2x mb-2"></i><br>Ekstrakurikuler
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="#" class="btn btn-outline-success w-100 py-3">
                        <i class="fas fa-calendar-alt fa-2x mb-2"></i><br>Jadwal Eskul
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="#" class="btn btn-outline-info w-100 py-3">
                        <i class="fas fa-clipboard-check fa-2x mb-2"></i><br>Riwayat Nilai
                    </a>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <a href="#" class="btn btn-outline-warning w-100 py-3">
                        <i class="fas fa-user-check fa-2x mb-2"></i><br>Riwayat Absen
                    </a>
                </div>
            </div>
            {{-- @endif --}}

        </div>
    </section>
</div>
@endsection
