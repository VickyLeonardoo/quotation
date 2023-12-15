@extends('partials.manager.header')

@section('title', 'Edit Produk')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="text-right">
                            <a href="{{ url('manager/produk') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-category"></div>
                    </div>
                    <form action="{{ route('manager.produk.update',$produk->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Produk</label>
                            <input type="text" class="form-control {{ $errors->has('kodeProduk') }}" name="kodeProduk" value="{{ $produk->kodeProduk }}" placeholder="Masukkan Nama Produk">
                            @error('kodeProduk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" class="form-control {{ $errors->has('namaProduk') }}" name="namaProduk" value="{{ $produk->namaProduk }}" placeholder="Masukkan Nama Produk">
                            @error('namaProduk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" class="form-control {{ $errors->has('hargaProduk') }}" name="hargaProduk" value="{{ $produk->hargaProduk }}" placeholder="Masukkan Nama Produk">
                            @error('hargaProduk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Simpan" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
