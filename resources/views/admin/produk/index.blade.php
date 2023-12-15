@extends('partials.admin.header')

@section('title', 'Produk')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
            <div class="alert alert-warning bg-danger alert-dismissible fade show text-white" role="alert">
                <button type="button" class="pull-right bg-danger" style="border: none;" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                {{ session('error') }}
            </div>
            @endif
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <a href="{{ url('admin/produk/create') }}" class="btn btn-info">Tambah</a>
                        <div class="card-category"></div>
                        <h4 class="page-title">Daftar Produk</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->kodeProduk }}</td>
                                        <td>{{ $produk->namaProduk }}</td>
                                        <td>@currency($produk->hargaProduk)</td>
                                        <td>
                                            <a href="{{ route('admin.produk.edit', $produk->slug) }}"
                                                class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger" id="alertDeleteProduk_{{ $produk->id }}"><i
                                                    class="fas fa-trash"></i> Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        @foreach ($produks as $produk)
            $('#alertDeleteProduk_{{ $produk->id }}').click(function(e) {
                swal({
                    title: 'Hapus Produk?',
                    text: "Produk akan dihapus dari daftar!",
                    type: 'warning',
                    buttons: {
                        cancel: {
                            visible: true,
                            text: 'Tidak, Batal!',
                            className: 'btn btn-danger'
                        },
                        confirm: {
                            text: 'Ya, Hapus!',
                            className: 'btn btn-success'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href =
                            '{{ route('admin.produk.delete', ['id' => $produk->id]) }}';
                    }
                });
            });
        @endforeach
    </script>
@endsection
