@extends('layouts.template_default')
@section('title', 'Halaman Admin')
@section('admin', 'active')

@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-0 text-xs">Halaman Admin</h5>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right text-xs">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Admin</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header py-2">
                                <a href="{{ route('admin.create') }}" class="btn btn-primary btn-xs">
                                    <i class="fa fa-plus"></i> Tambah Admin
                                </a>
                            </div>

                            <div class="card-body text-xs p-2" style="font-size: 12px;">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No HP</th>
                                                <th>Role</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($admins as $admin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->no_hp }}</td>
                                                    <td>{{ $admin->Level->level }}</td>
                                                    <td class="text-center">
                                                        @if ($admin->image)
                                                            <img src="{{ Storage::url($admin->image) }}" alt="gambar"
                                                                 width="80" height="80"
                                                                 class="img-fluid rounded-circle object-fit-cover">
                                                        @else
                                                            <img src="{{ asset('assets/img/user_default.png') }}" alt="default"
                                                                 width="80" height="80"
                                                                 class="img-fluid rounded-circle object-fit-cover">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-1">
                                                            <a href="{{ route('admin.edit', $admin->id) }}"
                                                               class="btn btn-warning btn-xs">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                            <form action="{{ route('admin.destroy', $admin->id) }}"
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-xs delete_confirm">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4">Data Kosong</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
