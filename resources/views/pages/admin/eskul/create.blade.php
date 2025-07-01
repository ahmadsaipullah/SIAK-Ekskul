@extends('layouts.template_default')
@section('title', 'Create Eskul')
@section('eskul', 'active')

@section('content')
<div class="content-wrapper">
    <div class="container mt-4">
        <!-- Form Card -->
        <div class="card card-primary">
            <div class="card-header py-2">
                <h6 class="text-center m-0 text-xs">Tambah Data Ekstrakurikuler</h6>
            </div>

            <form action="{{ route('eskul.store') }}" method="POST" class="text-xs" style="font-size: 12px;" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <!-- Nama Eskul -->
                    <div class="form-group">
                        <label for="nama_eskul">Nama Eskul</label>
                        <input type="text" class="form-control form-control-sm @error('nama_eskul') is-invalid @enderror"
                               id="nama_eskul" name="nama_eskul" placeholder="Contoh: Pramuka"
                               value="{{ old('nama_eskul') }}" required>
                        @error('nama_eskul')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control form-control-sm @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" placeholder="Deskripsi singkat" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Pelatih -->
                    <div class="form-group">
                        <label for="pelatih_id">Pelatih Eskul</label>
                        <select class="form-control form-control-sm @error('pelatih_id') is-invalid @enderror"
                                id="pelatih_id" name="pelatih_id" required>
                            <option value="">-- Pilih Pelatih --</option>
                            @foreach ($pelatih as $p)
                                <option value="{{ $p->id }}" {{ old('pelatih_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('pelatih_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jumlah Pertemuan -->
                    <div class="form-group">
                        <label for="jumlah_pertemuan">Jumlah Pertemuan</label>
                        <input type="number" class="form-control form-control-sm @error('jumlah_pertemuan') is-invalid @enderror"
                               id="jumlah_pertemuan" name="jumlah_pertemuan" placeholder="Contoh: 10"
                               value="{{ old('jumlah_pertemuan') }}" required>
                        @error('jumlah_pertemuan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tahun Ajaran -->
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control form-control-sm @error('tahun_ajaran') is-invalid @enderror"
                            name="tahun_ajaran" id="tahun_ajaran"
                            value="{{ old('tahun_ajaran') }}" placeholder="Contoh: 2024/2025" required>
                        @error('tahun_ajaran')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Logo Eskul -->
                    <div class="form-group">
                        <label for="logo">Logo Eskul</label>
                        <input type="file" name="logo" id="logo"
                            class="form-control form-control-sm @error('logo') is-invalid @enderror" accept="image/*">
                        @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-xs">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
