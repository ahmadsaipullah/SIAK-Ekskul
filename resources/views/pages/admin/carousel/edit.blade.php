@extends('layouts.template_default')
@section('title', 'Update Carousel Ekskul')
@section('carousel', 'active')

@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- Form Card -->
            <div class="card card-primary">
                <div class="card-header py-2">
                    <h6 class="text-center m-0 text-xs">Update Carousel Ekskul</h6>
                </div>

                <form action="{{ route('carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data" class="text-xs" style="font-size: 12px;">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">

                        <!-- Judul -->
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control form-control-sm @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" placeholder="Judul"
                                   value="{{ old('judul', $carousel->judul) }}" required>
                            @error('judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="form-group">
                            <label for="deskripsi">Penjelasan</label>
                            <textarea class="form-control form-control-sm @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" placeholder="Penjelasan singkat" rows="3" required>{{ old('deskripsi', $carousel->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="form-group">
                            <label for="image">Foto</label>
                            <div class="mb-2">
                                @if ($carousel->image)
                                    <img src="{{ Storage::url($carousel->image) }}" alt="gambar"
                                         width="100" height="100" class="img-fluid rounded">
                                @else
                                    <img src="{{ asset('assets/img/noimage.png') }}" alt="default"
                                         width="100" height="100" class="img-fluid rounded">
                                @endif
                            </div>
                            <input type="file" name="image" id="image"
                                   class="form-control form-control-sm @error('image') is-invalid @enderror">
                            @error('image')
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
