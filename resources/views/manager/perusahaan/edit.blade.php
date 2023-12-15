@extends('partials.manager.header')

@section('title', 'Edit Perusahaan')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="text-right">
                            <a href="{{ url('manager/perusahaan') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                        <div class="card-category"></div>
                    </div>
                    <form action="{{ route('manager.perusahaan.update',$perusahaan->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kode">Kode Perusahaan*:</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kode') ? 'is-invalid' : '' }}" name="kode"
                                        placeholder="Masukkan Kode Perusahaan" value="{{ $perusahaan->kode }}">
                                    @error('kode')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="nama">Nama Perusahaan*:</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" name="nama"
                                        placeholder="Masukkan Nama Perusahaan" value="{{ $perusahaan->nama }}">
                                    @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email*:</label>
                                    <input type="email"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"
                                        placeholder="Masukkan Email" value="{{ $perusahaan->email }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kota">Kota*:</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('kota') ? 'is-invalid' : '' }}" name="kota"
                                        placeholder="Masukkan Kota" value="{{ $perusahaan->kota }}">
                                    @error('kota')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="provinsi">Provinsi*:</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('provinsi') ? 'is-invalid' : '' }}"
                                        name="provinsi" placeholder="Masukkan Provinsi"
                                        value="{{ $perusahaan->provinsi }}">
                                    @error('provinsi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat*:</label>
                            <textarea class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" name="alamat"
                                placeholder="Masukkan Alamat">{{ $perusahaan->alamat }}</textarea>
                            @error('alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jalan1">Jalan 1:</label>
                                    <input type="text" class="form-control" name="jalan1" placeholder="Masukkan Jalan 1"
                                        value="{{ $perusahaan->jalan1 }}">
                                    <!-- Jalan 1 bersifat opsional, jadi tidak perlu validasi error -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jalan2">Jalan 2:</label>
                                    <input type="text" class="form-control" name="jalan2" placeholder="Masukkan Jalan 2"
                                        value="{{ $perusahaan->jalan2 }}">
                                    <!-- Jalan 2 bersifat opsional, jadi tidak perlu validasi error -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jalan3">Jalan 3:</label>
                                    <input type="text" class="form-control" name="jalan3" placeholder="Masukkan Jalan 3"
                                        value="{{ $perusahaan->jalan3 }}">
                                    <!-- Jalan 3 bersifat opsional, jadi tidak perlu validasi error -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="noTelp">Nomor Telepon:</label>
                                    <input type="text" class="form-control" name="noTelp"
                                        placeholder="Masukkan Nomor Telepon" value="{{ $perusahaan->noTelp }}">
                                    <!-- Nomor Telepon bersifat opsional, jadi tidak perlu validasi error -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fax">Fax:</label>
                                    <input type="text" class="form-control" name="fax"
                                        placeholder="Masukkan Nomor Fax" value="{{ $perusahaan->fax }}">
                                    <!-- Fax bersifat opsional, jadi tidak perlu validasi error -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kodePos">Kode Pos:</label>
                                    <input type="text" class="form-control" name="kodePos"
                                        placeholder="Masukkan Kode Pos" value="{{ $perusahaan->kodePos }}">
                                </div>
                                <!-- Kode Pos bersifat opsional, jadi tidak perlu validasi error -->
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="pic">Person in Charge (PIC)*:</label>
                            <input type="text" class="form-control {{ $errors->has('pic') ? 'is-invalid' : '' }}"
                                name="pic" placeholder="Masukkan Nama PIC" value="{{ $perusahaan->pic }}">
                            @error('pic')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
