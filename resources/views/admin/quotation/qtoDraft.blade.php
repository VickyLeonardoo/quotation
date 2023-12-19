@extends('partials.admin.header')

@section('title', Route::is('admin.quotation.draft') ? 'Quotation Draft':'Quotation Confirmed')

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
                        <a href="{{ url('admin/quotation-draft/create') }}" class="btn btn-info">Tambah</a>
                        <div class="card-category"></div>
                        <h4 class="page-title">Daftar Quotation</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quotations as $qto)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $qto->quotationNo }}</td>
                                    <td>{{ $qto->perusahaan->nama }}</td>
                                    <td>{{ Carbon\Carbon::parse($qto->tglQuotation)->format('d-M-Y') }}</td>
                                    <td bgcolor="{{ $qto->status == 5 ? 'red':'' }}">
                                        @if ($qto->status == 0)
                                            Draft
                                        @elseif ($qto->status == 1)
                                            Pending
                                        @elseif ($qto->status == 2)
                                            Accepted
                                        @elseif ($qto->status == 3)
                                            Confirmed
                                        @elseif ($qto->status == 5)
                                            Ditolak
                                        @else
                                            Selesai
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.quotation.view',$qto->id) }}" title="Quotation" class="btn btn-info"><i class="fas fa-file-invoice"></i></a>
                                        <a href="{{ route('admin.quotation.edit',$qto->id) }}" title="Edit" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger" title="Hapus" id="alertDeleteQto_{{ $qto->id }}"><i class="fas fa-trash"></i></button>
                                        <a href="{{ route('admin.quotation.set.archive',$qto->id) }}" title="Arsip" class="btn btn-secondary"><i class="fas fa-archive"></i></a>
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
        @foreach ($quotations as $qto)
            $('#alertDeleteQto_{{ $qto->id }}').click(function(e) {
                swal({
                    title: 'Hapus Quotation?',
                    text: "Anda akan menghapus quotation?.",
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
                            '{{ route('admin.quotation.delete', ['id' => $qto->id]) }}';
                    }
                });
            });
        @endforeach
    </script>
@endsection
