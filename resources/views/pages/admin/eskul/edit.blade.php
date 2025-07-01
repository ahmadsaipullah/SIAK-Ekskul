@extends('layouts.template_default')
@section('title', 'Update Data Eskul')
@section('eskul', 'active')

@section('content')
<div class="content-wrapper">
    <div class="container mt-4">
        <!-- Form Card -->
        <div class="card card-primary">
            <div class="card-header py-2">
                <h6 class="text-center m-0 text-xs">Update Data Ekstrakurikuler</h6>
            </div>

            <form action="{{ route('eskul.update', $eskul->id) }}" method="POST" enctype="multipart/form-data" class="text-xs" style="font-size: 12px;">
                @csrf
                @method('PATCH')

                <div class="card-body">

                    <!-- Nama Eskul -->
                    <div class="form-group">
                        <label for="nama_eskul">Nama Eskul</label>
                        <input type="text" class="form-control form-control-sm @error('nama_eskul') is-invalid @enderror"
                               id="nama_eskul" name="nama_eskul" placeholder="Contoh: Paskibra"
                               value="{{ old('nama_eskul', $eskul->nama_eskul) }}" required>
                        @error('nama_eskul')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control form-control-sm @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" placeholder="Deskripsi singkat" rows="3" required>{{ old('deskripsi', $eskul->deskripsi) }}</textarea>
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
                                <option value="{{ $p->id }}" {{ $p->id == old('pelatih_id', $eskul->pelatih_id) ? 'selected' : '' }}>
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
                               id="jumlah_pertemuan" name="jumlah_pertemuan" placeholder="Contoh: 8"
                               value="{{ old('jumlah_pertemuan', $eskul->jumlah_pertemuan) }}" required>
                        @error('jumlah_pertemuan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tahun Ajaran -->
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control form-control-sm @error('tahun_ajaran') is-invalid @enderror"
                               name="tahun_ajaran" id="tahun_ajaran"
                               value="{{ old('tahun_ajaran', $eskul->tahun_ajaran) }}" required>
                        @error('tahun_ajaran')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Logo Eskul -->
                    <div class="form-group">
                        <label for="logo">Logo Eskul</label>
                        <div class="mb-2">
                            @if ($eskul->logo)
                                <img src="{{ Storage::url($eskul->logo) }}" alt="logo" width="100" class="img-fluid rounded">
                            @else
                                <img src="{{ asset('assets/img/noimage.png') }}" alt="default" width="100" class="img-fluid rounded">
                            @endif
                        </div>
                        <input type="file" name="logo" id="logo"
                               class="form-control form-control-sm @error('logo') is-invalid @enderror" accept="image/*">
                        @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <!-- Submit -->
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-xs">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
