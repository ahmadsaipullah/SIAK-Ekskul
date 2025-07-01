@extends('layouts.template_default')
@section('title', 'Manajemen Eskul')
@section('eskul', 'active')

@section('content')
<div class="content-wrapper">
    @include('sweetalert::alert')

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-xs">Manajemen Ekstrakurikuler</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right text-xs">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Eskul</li>
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
                            <a href="{{ route('eskul.create') }}" class="btn btn-primary btn-xs">
                                <i class="fa fa-plus"></i> Tambah Eskul
                            </a>
                        </div>

                        <div class="card-body text-xs p-2" style="font-size: 12px;">
                            <div class="table-responsive">
                                <table id="Table" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Eskul</th>
                                            <th>Deskripsi</th>
                                            <th>Pelatih</th>
                                            <th>No Telepon</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Logo</th>
                                            <th>Jumlah Pertemuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($eskuls as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_eskul }}</td>
                                                <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                                <td>{{ $item->pelatih->name ?? '-' }}</td>
                                                <td>{{ $item->no_hp ?? '-' }}</td>
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                <td class="text-center">
                                                    @if ($item->logo)
                                                        <img src="{{ Storage::url($item->logo) }}" width="60" height="60"
                                                             class="rounded object-fit-cover" alt="Logo">
                                                    @else
                                                        <img src="{{ asset('assets/img/logoft.png') }}" width="60" height="60"
                                                             class="rounded object-fit-cover" alt="Default">
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $item->jumlah_pertemuan }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <a href="{{ route('eskul.edit', $item->id) }}"
                                                           class="btn btn-warning btn-xs">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                        <form action="{{ route('eskul.destroy', $item->id) }}"
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
                                                <td colspan="9" class="text-center py-4">Data Eskul Kosong</td>
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
