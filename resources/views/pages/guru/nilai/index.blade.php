@extends('layouts.template_default')
@section('title', 'Lihat Nilai Eskul')
@section('nilaiguru', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <h5>Daftar Nilai Eskul Seluruh Siswa</h5>
    </section>

    <section class="content mt-2">
        <div class="container-fluid">
            @foreach($eskuls as $e)
                @php $pendaftarans = $e->pendaftarans->where('status', 'Disetujui'); @endphp

                @if($pendaftarans->count())
                    <h6 class="text-primary">{{ $e->nama_eskul }}</h6>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftarans as $p)
                                    @php
                                        $nilai = optional($p->nilaiEskul);
                                    @endphp
                                    <tr>
                                        <td>{{ $p->user->name ?? '-' }}</td>
                                        <td class="text-center">{{ $nilai->nilai ?? '-' }}</td>
                                        <td>{{ $nilai->catatan ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
</div>
@endsection
