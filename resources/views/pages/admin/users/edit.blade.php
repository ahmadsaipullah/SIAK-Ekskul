@extends('layouts.template_default')
@section('title', 'Update Admin')

@section('content')
    <div class="content-wrapper">
        <div class="container mt-4">
            <!-- Form Card -->
            <div class="card card-primary">
                <div class="card-header py-2">
                    <h6 class="text-center m-0 text-xs">Update Admin</h6>
                </div>

                <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data" class="text-xs" style="font-size: 12px;">
                    @csrf
                    @method('patch')

                    <div class="card-body">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                                   id="name" name="name" placeholder="Nama"
                                   value="{{ old('name', $admin->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div class="form-group">
                            <label for="no_hp">Nomor Handphone</label>
                            <input type="number" class="form-control form-control-sm @error('no_hp') is-invalid @enderror"
                                   id="no_hp" name="no_hp" placeholder="Nomor Handphone"
                                   value="{{ old('no_hp', $admin->no_hp) }}" required>
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                                   id="email" name="email" placeholder="Email"
                                   value="{{ old('email', $admin->email) }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror"
                                   id="password" name="password" placeholder="Password"
                                   value="{{ old('password', $admin->password) }}" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Level User -->
                        <div class="form-group">
                            <label for="level_id">Level User</label>
                            <select class="form-control form-control-sm @error('level_id') is-invalid @enderror"
                                    id="level_id" name="level_id">
                                <option value="{{ $admin->level_id }}" selected>{{ $admin->level->level }}</option>
                                @foreach ($levels as $level)
                                    @if ($level->id !== $admin->level_id)
                                        <option value="{{ $level->id }}">{{ $level->level }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('level_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="form-group">
                            <label for="image">Foto Profil</label>
                            <div class="mb-2">
                                @if ($admin->image)
                                    <img src="{{ Storage::url($admin->image) }}" alt="gambar"
                                         width="80" height="80" class="img-fluid rounded-circle object-fit-cover">
                                @else
                                    <img src="{{ asset('assets/img/user_default.png') }}" alt="default"
                                         width="80" height="80" class="img-fluid rounded-circle object-fit-cover">
                                @endif
                            </div>
                            <input type="file" name="image" id="image"
                                   class="form-control form-control-sm @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-xs">
                            <i class="fa fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
