<!-- Main Sidebar Container -->
<style>
    .sidebar-school {
        background: linear-gradient(180deg, #3e8ed0 0%, #72c8ef 100%);
        color: #ffffff;
    }

    .sidebar-school .nav-link {
        color: #ffffff;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .sidebar-school .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        padding-left: 12px;
    }

    .sidebar-school .nav-icon {
        color: #ffffff !important;
    }

    .sidebar-school .brand-link {
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        background-color: transparent;
    }

    .sidebar-school .brand-link .brand-text {
        font-weight: bold;
        font-size: 16px;
    }

    .sidebar-school .nav-header {
        color: #f1faff;
        font-size: 13px;
        margin-top: 10px;
    }

    .sidebar-school .user-panel .info a {
        color: #fff;
        font-weight: 500;
    }

    .sidebar-school .user-panel .text-xs {
        color: #e0f7ff;
    }
</style>

<aside class="main-sidebar sidebar-school elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link d-flex align-items-center">
        <img src="{{ asset('assets/img/logoft.png') }}" alt="Logo Sekolah" class="brand-image img-circle elevation-3"
            style="opacity: .9; border: 2px solid white;">
        <span class="brand-text font-weight-light text-white ml-2">SMK PGRI CIKUPA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth()->user()->image)
                    <img src="{{ Storage::url(Auth()->user()->image) }}" alt="User Image" class="img-circle elevation-2"
                        style="width: 40px; height: 40px; object-fit: cover;">
                @else
                    <img src="{{ asset('assets/img/user_default.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('profile.index', encrypt(auth()->user()->id)) }}"
                    class="d-block">{{ Auth()->user()->name }}</a>
                <span class="text-xs"><i class="fa fa-circle text-success"></i> Online</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if (auth()->user()->level_id == 1)
                    <li class="nav-header">Admin Super</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link @yield('admin')">
                            <i class="nav-icon ion ion-person-add"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('carousel.index') }}" class="nav-link @yield('carousel')">
                            <i class="nav-icon ion ion-images"></i>
                            <p>Carousel</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('eskul.index') }}" class="nav-link @yield('eskul')">
                            <i class="nav-icon ion ion-ios-people"></i>
                            <p>Eskul</p>
                        </a>
                    </li>
                @elseif (auth()->user()->level_id == 2)
                    <li class="nav-header">Pelatih</li>

                    <li class="nav-item">
                        <a href="{{ route('pelatih.eskul.index') }}" class="nav-link @yield('eskul')">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Eskul Saya</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pertemuan.index') }}" class="nav-link @yield('pertemuan')">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>Pertemuan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pelatih.nilai.index') }}" class="nav-link @yield('nilai')">
                            <i class="nav-icon fas fa-star"></i>
                            <p>Penilaian</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pelatih.absensi.index') }}" class="nav-link @yield('absensi')">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>Riwayat Absen</p>
                        </a>
                    </li>
                @elseif (auth()->user()->level_id == 3)
                    <li class="nav-header">Wali Kelas</li>

                    <li class="nav-item">
                        <a href="{{ route('guru.nilai.index') }}" class="nav-link @yield('nilaiguru')">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Nilai Siswa</p>
                        </a>
                    </li>
                @elseif (auth()->user()->level_id == 4)
                    <li class="nav-header">Siswa</li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.eskul.index') }}" class="nav-link @yield('eskul')">
                            <i class="nav-icon fa fa-graduation-cap"></i>
                            <p>Ekstrakurikuler</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.jadwal.index') }}" class="nav-link @yield('jadwal')">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Jadwal Eskul</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.nilai.index') }}" class="nav-link @yield('nilai')">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>Riwayat Nilai</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.absensi.index') }}" class="nav-link @yield('absensi')">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>Riwayat Absen</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
