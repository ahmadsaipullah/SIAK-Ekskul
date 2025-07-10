@extends('layouts.template_default')
@section('title', 'Peserta ' . $eskul->nama_eskul)
@section('pelatih_eskul', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <h4 class="font-weight-bold mb-1">Peserta Terdaftar - {{ $eskul->nama_eskul }}</h4>
        <p class="text-muted">Daftar siswa yang mendaftar pada ekstrakurikuler ini</p>
    </section>

    <section class="content mt-2">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-2">
                    <h6 class="mb-0"><i class="fas fa-users"></i> Daftar Pendaftar</h6>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-sm table-hover table-bordered mb-0">
                        <thead class="thead-light text-center">
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftar as $p)
                            <tr class="text-center align-middle">
                                <td>{{ $p->user->name }}</td>
                                <td>
                                    <span class="badge
                                        {{ $p->status == 'Disetujui' ? 'badge-success' :
                                           ($p->status == 'Ditolak' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($p->status == 'Pending')
                                        <form action="{{ route('pelatih.eskul.approve', [$eskul->id, $p->user->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-xs btn-success" title="Setujui">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('pelatih.eskul.reject', [$eskul->id, $p->user->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-xs btn-danger" title="Tolak">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </form>
                                    @else
                                        <i class="text-muted">-</i>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada pendaftar untuk eskul ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Tambahan Styling --}}
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
        transition: 0.2s ease-in-out;
    }
</style>
@endsection
