@extends('layouts.template_default')
@section('title', 'Riwayat Nilai')
@section('nilai', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid text-center">
            <h5 class="font-weight-bold">Riwayat Nilai Ekstrakurikuler</h5>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if($nilais->isEmpty())
                        <div class="text-center py-5">
                            <img src="{{ asset('images/empty-grade.svg') }}" alt="Kosong" width="120">
                            <h6 class="mt-3 text-muted">Belum ada nilai yang diberikan</h6>
                            <p class="text-muted small">Nilai akan muncul setelah pelatih menginputkannya.</p>
                        </div>
                    @else
                        <table class="table table-sm table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Eskul</th>
                                    <th>Nilai</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nilais as $nilai)
                                <tr>
                                    <td>{{ $nilai->eskul->nama_eskul }}</td>
                                    <td>{{ $nilai->nilai ?? '-' }}</td>
                                    <td>{{ $nilai->catatan ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
