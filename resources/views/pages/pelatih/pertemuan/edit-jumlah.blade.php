@extends('layouts.template_default')
@section('title', 'Edit Jumlah Pertemuan')
@section('pertemuan', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center mt-3">
        <h5 class="font-weight-bold">Edit Jumlah Pertemuan</h5>
        <p class="text-muted">Perbarui total pertemuan untuk eskul berikut</p>
    </section>

    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white py-2">
                            <h6 class="mb-0">Form Edit Jumlah Pertemuan</h6>
                        </div>
                        <form action="{{ route('pertemuan.update.jumlah', $eskul->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_eskul">Nama Ekstrakurikuler</label>
                                    <input type="text" class="form-control" id="nama_eskul" value="{{ $eskul->nama_eskul }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_pertemuan">Jumlah Pertemuan</label>
                                    <input type="number" name="jumlah_pertemuan" id="jumlah_pertemuan" class="form-control" min="1" value="{{ $eskul->jumlah_pertemuan }}" required>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <a href="{{ route('pertemuan.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
