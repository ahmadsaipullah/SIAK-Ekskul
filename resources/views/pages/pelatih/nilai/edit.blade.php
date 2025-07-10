@extends('layouts.template_default')
@section('title', 'Edit Nilai Siswa')
@section('nilai', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <h5>Edit Nilai Siswa</h5>
    </section>

    <section class="content mt-2">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pelatih.nilai.update', $nilaiEskul->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control" value="{{ $nilaiEskul->user->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Ekstrakurikuler</label>
                            <input type="text" class="form-control" value="{{ $nilaiEskul->eskul->nama_eskul }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="number" name="nilai" class="form-control" value="{{ $nilaiEskul->nilai }}" required min="0" max="100">
                        </div>

                        <div class="form-group">
                            <label>Catatan (opsional)</label>
                            <textarea name="catatan" class="form-control" rows="2">{{ $nilaiEskul->catatan }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                        <a href="{{ route('pelatih.nilai.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
