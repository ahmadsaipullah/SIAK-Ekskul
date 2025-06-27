@extends('layouts.template_default')
@section('title', 'Carousel Ekskul')
@section('carousel', 'active')

@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-0 text-xs">Carousel Ekskul</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right text-xs">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Carousel Ekskul</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header py-2">
                                <a href="{{ route('carousel.create') }}" class="btn btn-primary btn-xs">
                                    <i class="fa fa-plus"></i> Tambah Carousel
                                </a>
                            </div>

                            <div class="card-body text-xs p-2" style="font-size: 12px;">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Deskripsi</th>
                                                <th>Foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($items as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                                    <td class="text-center">
                                                        <img src="{{ Storage::url($item->image) }}" width="80" height="80"
                                                             class="rounded object-fit-cover" alt="image">
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-1">
                                                            <a href="{{ route('carousel.edit', $item->id) }}"
                                                               class="btn btn-warning btn-xs">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                            <form action="{{ route('carousel.destroy', $item->id) }}"
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs delete_confirm">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4">Data Kosong</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
