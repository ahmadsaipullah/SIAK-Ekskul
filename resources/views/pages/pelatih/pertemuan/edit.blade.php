@extends('layouts.template_default')
@section('title', 'Edit Pertemuan')
@section('pertemuan', 'active')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header text-center">
        <h5>Edit Pertemuan</h5>
    </section>

    <!-- Form Edit -->
    <section class="content mt-2">
        <div class="container-fluid">
            <form action="{{ route('pertemuan.update', $pertemuan->id) }}" method="POST" class="card card-body shadow-sm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Ekstrakurikuler</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $pertemuan->eskul->nama_eskul ?? '-' }}" readonly>
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control form-control-sm"
                           value="{{ $pertemuan->tanggal }}" required>
                </div>

                <div class="form-group">
                    <label>Materi</label>
                    <textarea name="materi" class="form-control form-control-sm" required>{{ $pertemuan->materi }}</textarea>
                </div>

                <div class="form-group text-right">
                    <a href="{{ route('pertemuan.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
