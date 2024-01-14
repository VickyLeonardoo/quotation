@extends('partials.admin.header')

@section('title', 'Edit Produk')

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
                    <form action="{{ route('admin.produk.update',$produk->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Kode Produk</label>
                            <input type="text" class="form-control {{ $errors->has('kodeProduk') }}" name="kodeProduk" value="{{ $produk->kodeProduk }}" placeholder="Masukkan Kode Produk">
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
                            <label for="">Brands</label>
                            <input type="text" class="form-control {{ $errors->has('brands') }}" name="brands" value="{{ $produk->brands }}" placeholder="Masukkan Nama Produk">
                            @error('brands')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">UOM</label>
                            <select name="uom" class="form-control">
                                <option value="" {{ $produk->uom == '' ? 'selected':''}}>Jasa</option>
                                <option value="meters" {{ $produk->uom == 'meters' ? 'selected':''}}>Meter</option>
                                <option value="kg" {{ $produk->uom == 'kg' ? 'selected':''}}>Kg</option>
                                <option value="pcs" {{ $produk->uom == 'pcs' ? 'selected':''}}>Pcs</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" class="form-control {{ $errors->has('hargaProduk') }}" name="hargaProduk" value="{{ $produk->hargaProduk }}" placeholder="Masukkan Harga Produk">
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
