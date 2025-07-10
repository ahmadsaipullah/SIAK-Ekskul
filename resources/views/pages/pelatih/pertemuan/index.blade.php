@extends('layouts.template_default')
@section('title', 'pertemuan')
@section('pertemuan', 'active')

@section('content')
 @include('sweetalert::alert')
<div class="content-wrapper">
    <section class="content-header text-center">
        <h5>Jadwal Pertemuan Eskul</h5>
    </section>
    <section class="content mt-2">
            @include('sweetalert::alert')
        <div class="container-fluid">
            <a href="{{ route('pertemuan.create') }}" class="btn btn-sm btn-primary mb-2">Tambah Pertemuan</a>
            <div class="card shadow-sm">
                <div class="card-body">
                    <table id="Table" class="table table-sm table-bordered">
                        <thead><tr><th>Eskul</th><th>Tanggal</th><th>Materi</th><th>Pertemuan</th><th>Aksi</th></tr></thead>
                        <tbody>
                            @foreach ($eskuls as $e)
                                @foreach($e->pertemuans as $pt)
                                <tr>
                                    <td>{{ $e->nama_eskul }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pt->tanggal)->format('d-M-Y') }}</td>
                                    <td>{{ $pt->materi }}</td>
                                    <td>{{ $e->jumlah_pertemuan }}</td>
                                    <td>
                                        <a href="{{ route('pertemuan.edit.jumlah', $pt->id) }}" class="btn btn-xs btn-warning">jumlah Pertemuan✏️</a>
                                        <a href="{{ route('pertemuan.edit', $pt->id) }}" class="btn btn-xs btn-warning">Pertemuan✏️</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
