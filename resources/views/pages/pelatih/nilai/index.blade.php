@extends('layouts.template_default')
@section('title', 'nilai')
@section('nilai', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <h5>Penilaian Siswa</h5>
    </section>
 @include('sweetalert::alert')
    <section class="content mt-2">
        <div class="container-fluid">
            <form action="{{ route('pelatih.nilai.store') }}" method="POST" class="card shadow-sm">
                @csrf
                <div class="card-body">
                    @foreach($eskuls as $e)
                        @php $pendaftarans = $e->pendaftarans->where('status', 'Disetujui'); @endphp

                        @if($pendaftarans->count())
                            <h6 class="text-primary">{{ $e->nama_eskul }}</h6>

                            <div class="table-responsive">
                                <table id="Table" class="table table-bordered table-sm">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                            <th>Catatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendaftarans as $p)
                                            @php
                                                $nilai = optional($p->nilaiEskul);
                                            @endphp
                                            <tr>
                                                <td>{{ $p->user->name ?? '-' }}</td>
                                                <td>
                                                    <input type="hidden" name="eskul_id[]" value="{{ $e->id }}">
                                                    <input type="hidden" name="user_id[]" value="{{ $p->user_id }}">
                                                    <input type="number" name="nilai[]" class="form-control form-control-sm" placeholder="Nilai" min="0" max="100" value="{{ $nilai->nilai }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="catatan[]" class="form-control form-control-sm" placeholder="Catatan (opsional)" value="{{ $nilai->catatan }}">
                                                </td>
                                                <td class="text-center">
                                                    @if($nilai->id)
                                                        <a href="{{ route('pelatih.nilai.edit', $nilai->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                        <form action="{{ route('pelatih.nilai.destroy', $nilai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus nilai ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    @else
                                                        <span class="text-muted">Belum Ada</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        @endif
                    @endforeach

                    <button class="btn btn-sm btn-success mt-3"><i class="fa fa-save"></i> Simpan Semua Nilai</button>
                </div>
            </form>

            {{-- Tabel Rekap Nilai --}}
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <strong>Rekap Nilai Siswa</strong>
                </div>
                <div class="card-body p-2">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light text-center">
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Eskul</th>
                                <th>Nilai</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($eskuls as $e)
                                @foreach($e->pendaftarans->where('status', 'Disetujui') as $p)
                                    @if($p->nilaiEskul)
                                    <tr>
                                        <td>{{ $p->user->name }}</td>
                                        <td>{{ $e->nama_eskul }}</td>
                                        <td class="text-center">{{ $p->nilaiEskul->nilai }}</td>
                                        <td>{{ $p->nilaiEskul->catatan }}</td>
                                    </tr>
                                    @endif
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
