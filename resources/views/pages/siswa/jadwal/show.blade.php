@extends('layouts.template_default')
@section('title', 'Detail Jadwal')
@section('jadwal', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid text-center">
            <h5 class="font-weight-bold">{{ $eskul->nama_eskul }}</h5>
            <p class="text-muted">Jadwal Kegiatan</p>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if($eskul->jadwals->isEmpty())
                        <p class="text-center text-muted">Belum ada jadwal yang tersedia untuk eskul ini.</p>
                    @else
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($eskul->jadwals as $jadwal)
                            <tr>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                                <td>{{ $jadwal->lokasi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                    <a href="{{ route('siswa.absensi.index') }}" class="btn btn-success btn-sm mt-3">
                        <i class="fa fa-check"></i> Lihat Absensi & Pertemuan
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
