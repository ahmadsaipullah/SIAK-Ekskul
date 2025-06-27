@extends('layouts.template_default')
@section('title', 'Create Admin')

@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- Form Card -->
            <div class="card card-primary">
                <div class="card-header py-2">
                    <h6 class="text-center m-0 text-xs">Create Admin</h6>
                </div>

                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="text-xs" style="font-size: 12px;">
                    @csrf
                    <div class="card-body">

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                                   id="name" name="name" placeholder="Nama"
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nomor HP -->
                        <div class="form-group">
                            <label for="no_hp">Nomor Handphone</label>
                            <input type="number" class="form-control form-control-sm @error('no_hp') is-invalid @enderror"
                                   id="no_hp" name="no_hp" placeholder="Nomor Handphone"
                                   value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                                   id="email" name="email" placeholder="Email"
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Password" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Level User -->
                        <div class="form-group">
                            <label for="level_id">Level User</label>
                            <select class="form-control form-control-sm @error('level_id') is-invalid @enderror"
                                    id="level_id" name="level_id" required>
                                <option disabled selected>-- Pilih Level User --</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->level }}</option>
                                @endforeach
                            </select>
                            @error('level_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-xs">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
