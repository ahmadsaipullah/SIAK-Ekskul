@extends('layouts.template_default')
@section('title', 'Create Carousel Ekskul')

@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- Form Card -->
            <div class="card card-primary">
                <div class="card-header py-2">
                    <h6 class="text-center m-0 text-xs">Create Carousel Ekskul</h6>
                </div>

                <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data" class="text-xs" style="font-size: 12px;">
                    @csrf
                    <div class="card-body">

                        <!-- Judul -->
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control form-control-sm @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" placeholder="Judul"
                                   value="{{ old('judul') }}" required>
                            @error('judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group">
                            <label for="deskripsi">Penjelasan</label>
                            <textarea class="form-control form-control-sm @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" placeholder="Penjelasan singkat" rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="form-group">
                            <label for="image">Upload Foto</label>
                            <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            @error('image')
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
