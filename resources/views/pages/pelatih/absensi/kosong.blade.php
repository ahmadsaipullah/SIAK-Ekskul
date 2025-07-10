@extends('layouts.template_default')
@section('title', 'Riwayat Absensi')
@section('absensi', 'active')

@section('content')
<div class="content-wrapper">
    <div class="container text-center mt-5">
        <h5 class="text-danger">Anda belum terhubung dengan ekstrakurikuler manapun.</h5>
        <p>Silakan hubungi admin untuk didaftarkan sebagai pelatih pada salah satu ekstrakurikuler.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm mt-3">
            <i class="fa fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
