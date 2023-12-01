@extends('partials.admin.header')

@section('title', 'Edit Karyawan')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="text-right">
                            <a href="{{ url('admin/karyawan') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-category"></div>
                    </div>
                    <form action="" method="POST"></form>
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Produk" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan Nama Produk" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Simpan" >
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
