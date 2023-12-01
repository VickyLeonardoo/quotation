@extends('partials.admin.header')

@section('title', 'Tambah Karyawan')

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
                    <form action="{{ route('admin.karyawan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" name="name" placeholder="Masukkan Nama Karyawan" value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" name="email" placeholder="Masukkan Email Karyawan" value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Simpan" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
