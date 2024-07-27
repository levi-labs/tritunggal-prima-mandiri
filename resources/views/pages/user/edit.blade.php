@extends('layout.main')

@section('content')
    <div class="container-fluid">
        <div class="row-column-title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>{{ $title }}</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="col-md-6">
                <div class="card">


                    <div class="card-body">
                        <h5 class="card-title">Form Edit User</h5>
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value={{ $user->nama }}>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value={{ $user->username }}>
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option selected disabled>Pilih Role</option>
                                    <option {{ $user->role == 'administrator' ? 'selected' : '' }} value="administrator">
                                        Administrator</option>
                                    <option {{ $user->role == 'penjualan' ? 'selected' : '' }} value="penjualan">Penjualan
                                    </option>
                                    <option {{ $user->role == 'pembelian' ? 'selected' : '' }} value="pembelian">Pembelian
                                    </option>
                                    <option {{ $user->role == 'gudang' ? 'selected' : '' }} value="gudang">Gudang</option>
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
