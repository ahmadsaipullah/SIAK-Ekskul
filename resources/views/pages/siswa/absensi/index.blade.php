@extends('layouts.template_default')
@section('title', 'Riwayat Absensi')
@section('absensi', 'active')

@section('content')
<div class="content-wrapper">
    @include('sweetalert::alert')

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid text-center">
            <h4 class="font-weight-bold mb-1">{{ $eskul->nama_eskul }}</h4>
            <p class="text-muted mb-0">Riwayat Kehadiran Ekstrakurikuler</p>
        </div>
    </section>

    <!-- Tabel Absensi -->
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-2">
                    <h6 class="mb-0">Data Absensi</h6>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="Table" class="table table-sm table-hover table-bordered mb-0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th width="15%">Tanggal</th>
                                <th>Materi</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensis as $absen)
                            <tr class="text-center align-middle">
                                <td>{{ \Carbon\Carbon::parse($absen->pertemuan->tanggal)->format('d M Y') }}</td>
                                <td class="text-left">{{ $absen->pertemuan->materi }}</td>
                                <td>
                                    <span class="badge
                                        {{ $absen->status == 'hadir' ? 'badge-success' :
                                           ($absen->status == 'izin' ? 'badge-warning' :
                                           ($absen->status == 'alfa' ? 'badge-danger' : 'badge-secondary')) }}">
                                        {{ ucfirst($absen->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($absen->foto)
                                        <img src="{{ Storage::url($absen->foto) }}" width="50" class="rounded shadow-sm">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $absen->lokasi ?? '-' }}</td>
                                <td>
                                    @if($absen->status == 'alfa' && \Carbon\Carbon::parse($absen->pertemuan->tanggal)->isToday())
                                        <button class="btn btn-sm btn-success btn-absen"
                                            data-toggle="modal"
                                            data-target="#absenModal"
                                            data-id="{{ $absen->pertemuan_id }}">
                                            Absen
                                        </button>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data absensi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Absen -->
<div class="modal fade" id="absenModal" tabindex="-1" role="dialog" aria-labelledby="absenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" action="" enctype="multipart/form-data" class="modal-content" id="formAbsen">
            @csrf
            <div class="modal-header">
                <h6 class="modal-title">Form Absensi Hari Ini</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Ambil Foto Kehadiran</label>
                    <input type="file"
                           id="fotoInput"
                           accept="image/*"
                           capture="environment"
                           class="form-control form-control-sm"
                           required>
                    <canvas id="canvasPreview" class="mt-2" style="display: none; width: 100%; max-height: 300px;"></canvas>
                    <input type="hidden" name="foto" id="fotoBase64">
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" id="modalLokasi" readonly required class="form-control form-control-sm">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-sm">Kirim Absen</button>
            </div>
        </form>
    </div>
</div><script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script>
let currentLocation = '';

// Ambil lokasi otomatis (nama tempat)
window.onload = function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const long = position.coords.longitude;

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${long}`)
                .then(res => res.json())
                .then(data => {
                    const lokasi =
                        data.address.city ||
                        data.address.town ||
                        data.address.village ||
                        data.address.suburb ||
                        data.display_name ||
                        `${lat},${long}`;
                    document.getElementById('modalLokasi').value = lokasi;
                    currentLocation = lokasi;
                })
                .catch(() => {
                    document.getElementById('modalLokasi').value = 'Lokasi tidak terdeteksi';
                    currentLocation = 'Tidak diketahui';
                });
        });
    }
};

// Ubah action form saat klik absen
document.querySelectorAll('.btn-absen').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const form = document.querySelector('#formAbsen');
        form.action = `/siswa/absensi/${id}`;
    });
});

// Preview & watermark foto
document.getElementById('fotoInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const canvas = document.getElementById('canvasPreview');
    const ctx = canvas.getContext('2d');
    const reader = new FileReader();

    reader.onload = function (e) {
        const img = new Image();
        img.onload = function () {
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);

            const now = new Date();
            const waktu = now.toLocaleString();
            const lokasi = currentLocation;

            ctx.fillStyle = "rgba(0, 0, 0, 0.5)";
            ctx.fillRect(0, img.height - 60, img.width, 60);

            ctx.fillStyle = "white";
            ctx.font = "30px Arial";
            ctx.fillText(`Waktu: ${waktu}`, 10, img.height - 30);
            ctx.fillText(`Lokasi: ${lokasi}`, 10, img.height - 5);

            canvas.style.display = 'block';

            const base64 = canvas.toDataURL("image/jpeg", 0.9);
            document.getElementById('fotoBase64').value = base64;
        };
        img.src = e.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});
</script>

@endsection
