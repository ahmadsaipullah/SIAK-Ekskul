@extends('layouts.template_default')
@section('title', 'Riwayat Absensi')
@section('absensi', 'active')

@section('content')
<div class="content-wrapper">
    <div class="container text-center mt-5">
        <h5 class="text-danger">Kamu belum terdaftar pada ekstrakurikuler apapun.</h5>
        <p>Silakan daftar terlebih dahulu untuk melihat dan mengisi absensi.</p>
        <a href="{{ route('siswa.eskul.index') }}" class="btn btn-primary btn-xs mt-3">
            <i class="fa fa-arrow-left"></i> Daftar Eskul
        </a>
    </div>
</div>
@endsection
