@extends('partials.admin.header')

@section('title', 'Perusahaan')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <a href="{{ url('admin/perusahaan/create') }}" class="btn btn-info">Tambah</a>
                        <div class="card-category"></div>
                        <h4 class="page-title">Daftar Perusahaan</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perusahaans as $perusahaan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $perusahaan->nama }}</td>
                                    <td>{{ $perusahaan->alamat }}</td>
                                    <td>{{ $perusahaan->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.perusahaan.edit',$perusahaan->slug) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" id="alertDeletePerusahaan_{{ $perusahaan->id }}"><i class="fas fa-trash"></i> Hapus</button>

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
        @foreach ($perusahaans as $perusahaan)
            $('#alertDeletePerusahaan_{{ $perusahaan->id }}').click(function(e) {
                swal({
                    title: 'Hapus Perusahaan?',
                    text: "Perusahaan akan dihapus dari daftar!",
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
                            '{{ route('admin.perusahaan.delete', ['id' => $perusahaan->id]) }}';
                    }
                });
            });
        @endforeach
    </script>
@endsection
