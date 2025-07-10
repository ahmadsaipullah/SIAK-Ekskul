@extends('layouts.template_default')
@section('title', 'Tambah Pertemuan')
@section('pertemuan', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center"><h5>Tambah Pertemuan Baru</h5></section>
    <section class="content mt-2"><div class="container-fluid">
        <form action="{{ route('pertemuan.store') }}" method="POST" class="card card-body shadow-sm">
            @csrf
            <div class="form-group">
                <label>Ekstrakurikuler</label>
                <select name="eskul_id" class="form-control form-control-sm" required>
                    <option value="">-- Pilih Eskul --</option>
                    @foreach($eskuls as $e)
                    <option value="{{ $e->id }}">{{ $e->nama_eskul }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><label>Tanggal</label><input type="date" name="tanggal" class="form-control form-control-sm" required></div>
            <div class="form-group"><label>Materi</label><textarea name="materi" class="form-control form-control-sm" required></textarea></div>
            <button class="btn btn-sm btn-success">Simpan</button>
            <a href="{{ route('pertemuan.index') }}" class="btn btn-sm btn-secondary">Batal</a>
        </form>
    </div></section>
</div>
@endsection
