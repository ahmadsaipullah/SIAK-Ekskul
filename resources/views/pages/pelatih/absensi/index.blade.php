@extends('layouts.template_default')
@section('title', 'Riwayat Absensi Siswa')
@section('absensi', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h4 class="text-center font-weight-bold">{{ $eskul->nama_eskul }}</h4>
            <p class="text-muted text-center mb-0">Riwayat Absensi Seluruh Siswa</p>
        </div>
    </section>
 @include('sweetalert::alert')
    <section class="content mt-3">
        <div class="container-fluid">
            @foreach($dataAbsensi as $item)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Rekap Absensi</h6>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="Table" class="table table-bordered table-sm mb-0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th>Materi</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->riwayat as $index => $riwayat)
                            <tr class="text-center align-middle">
                                <td>{{ $index + 1 }}</td>
                                <td class="text-left">{{ $item->siswa->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($riwayat->pertemuan->tanggal)->format('d M Y') }}</td>
                                <td class="text-left">{{ $riwayat->pertemuan->materi }}</td>
                                <td>
                                    <span class="badge
                                        {{ $riwayat->status == 'hadir' ? 'badge-success' :
                                           ($riwayat->status == 'izin' ? 'badge-warning' :
                                           ($riwayat->status == 'alfa' ? 'badge-danger' : 'badge-secondary')) }}">
                                        {{ ucfirst($riwayat->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($riwayat->foto)
                                        <img src="{{ Storage::url($riwayat->foto) }}" width="50" class="rounded shadow-sm">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $riwayat->lokasi ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
