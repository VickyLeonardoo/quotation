@extends('partials.admin.header')

@section('title', 'Tambah Produk')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="text-right">
                            <a href="{{ url('admin/produk') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-category"></div>
                    </div>
                    <form action="{{ route('admin.produk.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Produk*</label>
                            <input type="text" class="form-control {{ $errors->has('kodeProduk') ? 'is-invalid':'' }}" name="kodeProduk" placeholder="Masukkan Nama Produk" autocomplete="off" value="{{ old('kodeProduk') }}">
                            @error('kodeProduk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Produk*</label>
                            <input type="text" autocomplete="off" class="form-control {{ $errors->has('namaProduk') ? 'is-invalid':'' }}" name="namaProduk" placeholder="Masukkan Nama Produk" value="{{ old('namaProduk') }}">
                            @error('namaProduk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Brands</label>
                            <input type="text" autocomplete="off" class="form-control {{ $errors->has('brands') ? 'is-invalid':'' }}" name="brands" placeholder="Masukkan Brand Produk" value="{{ old('brands') }}">
                            @error('brands')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">UOM</label>
                            <select name="uom" class="form-control">
                                <option value="">Jasa</option>
                                <option value="meters">Meter</option>
                                <option value="kg">Kg</option>
                                <option value="pcs">Pcs</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Harga*</label>
                            <input type="number" autocomplete="off" class="form-control {{ $errors->has('hargaProduk') ? 'is-invalid':'' }}" name="hargaProduk" placeholder="Masukkan Nama Produk" value="{{ old('hargaProduk') }}">
                            @error('hargaProduk')
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
