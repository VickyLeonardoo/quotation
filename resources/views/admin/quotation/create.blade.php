@extends('partials.admin.header')

@section('title', 'Tambah Quotation')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="text-right">
                            <a href="{{ url('admin/quotation-draft') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                        <div class="card-category"></div>
                    </div>
                    <form action="{{ route('admin.quotation.draft.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Perusahaan</label>
                            <select name="perusahaan_id" class="form-control selectpicker" data-live-search="true">
                                @foreach ($perusahaans as $perusahaan)
                                    <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Quotation No</label>
                            <input type="text" readonly class="form-control" name="quotation_no"
                                value="{{ $qtoNo }}">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <input type="text" class="form-control" name="tglQuotation" placeholder="Masukkan Tanggal"
                                    onfocus="(this.type='date')"onblur="(this.type='text')">
                                    @error('tglQuotation')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Garansi</label>
                                    <input type="text" class="form-control {{ $errors->has('garansi') ? 'is-invalid':'' }}" name="garansi" placeholder="Masukkan Garansi">
                                    @error('garansi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Periode</label>
                                    <select name="periode" class="form-control">
                                        <option value="Months">Bulan</option>
                                        <option value="Years">Tahun</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Produk</label>
                            <div id="produk-container">
                                <div class="input-group mb-2">
                                    <select name="produk_id[]" class="form-control">
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}">{{ $produk->kodeProduk }} -
                                                {{ $produk->namaProduk }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append col-4">
                                        <input type="number" name="quantity[]" class="form-control" placeholder="Quantity">
                                    </div>

                                    <div class="input-group-append">
                                        <button class="btn btn-secondary tambah-produk" type="button">Tambah
                                            Produk</button>
                                    </div>
                                </div>
                            </div>
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
@section('js')
    <script>
        $('.tambah-produk').click(function() {
            @if (isset($produk))
                var newInput = '<div class="input-group mb-2">' +
                    '<select name="produk_id[]" class="form-control">' +
                    '@foreach ($produks as $produk)' +
                    '<option value="{{ $produk->id }}">{{ $produk->kodeProduk }} - {{ $produk->namaProduk }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '<div class="input-group-append col-4">' +
                    '<input type="number" name="quantity[]" class="form-control" placeholder="Quantity">' +
                    '</div>' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-secondary hapus-produk" type="button">Hapus</button>' +
                    '</div>' +
                    '</div>';
                $('#produk-container').append(newInput);
            @else
                console.log('Variabel $produk tidak ada');
            @endif
        });

        $(document).on('click', '.hapus-produk', function() {
            $(this).closest('.input-group').remove();
        });

        // Add this code to prevent quantity from going below 0
        $(document).on('change', 'input[name="quantity[]"]', function() {
            var currentValue = parseInt($(this).val());
            if (currentValue <= 0) {
                $(this).val(1);
            }
        });
    </script>
@endsection
