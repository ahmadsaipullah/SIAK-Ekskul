@extends('layouts.template_default')
@section('title', 'Tambah Nilai Siswa')
@section('nilai', 'active')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid text-center">
            <h5 class="font-weight-bold">Tambah Nilai Siswa</h5>
        </div>
    </section>

    <section class="content mt-2">
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pelatih.nilai.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="eskul_id">Pilih Ekstrakurikuler</label>
                            <select name="eskul_id" class="form-control" required>
                                <option value="">-- Pilih Eskul --</option>
                                @foreach($eskuls as $eskul)
                                    <option value="{{ $eskul->id }}">{{ $eskul->nama_eskul }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_id">Pilih Siswa</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="number" name="nilai" class="form-control" placeholder="Masukkan nilai" min="0" max="100" required>
                        </div>

                        <div class="form-group">
                            <label>Catatan (Opsional)</label>
                            <textarea name="catatan" class="form-control" rows="2" placeholder="Masukkan catatan jika ada"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Nilai</button>
                        <a href="{{ route('pelatih.nilai.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
