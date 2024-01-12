@extends('partials.admin.header')

@section('title', Route::is('admin.invoice.draft') ? 'Invoice Draft':'Invoice Confirmed')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
            <div class="alert alert-transparent bg-danger alert-dismissible fade show text-white" role="alert">
                <button type="button" class="pull-right bg-danger" style="border: none;" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                    {{ session('error') }}
            </div>
            @endif
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <a href="{{ url('admin/invoice-draft/create') }}" class="btn btn-info">Tambah</a>
                        <div class="card-category"></div>
                        <h4 class="page-title">Daftar Invoice</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No</th>
                                    <th>Quotation No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $inv)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $inv->invoiceNo }}</td>
                                    <td>{{ $inv->quotation->quotationNo }}</td>
                                    <td>{{ $inv->quotation->perusahaan->nama }}</td>
                                    <td>{{ Carbon\Carbon::parse($inv->quotation->tglQuotation)->format('d-M-Y') }}</td>
                                    <td bgcolor="{{ $inv->status == 5 ? 'red':'' }}">
                                        @if ($inv->status == 0)
                                            Draft
                                        @elseif ($inv->status == 1)
                                            Pending
                                        @elseif ($inv->status == 2)
                                            Approved
                                        @elseif ($inv->status == 3)
                                            Accepted
                                        @elseif ($inv->status == 4)
                                            Selesai
                                        @elseif ($inv->status == 5)
                                            Ditolak
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.invoice.view',$inv->id) }}" title="Quotation" class="btn btn-info"><i class="fas fa-file-invoice"></i></a>
                                        <a href="{{ route('admin.invoice.edit',$inv->id) }}" title="Edit" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger" title="Hapus" id="alertDeleteInv{{ $inv->id }}"><i class="fas fa-trash"></i></button>
                                        <a href="{{ route('admin.invoice.set.archive',$inv->id) }}" title="Arsip" class="btn btn-secondary"><i class="fas fa-archive"></i></a>

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
        @foreach ($invoices as $inv)
            $('#alertDeleteInv{{ $inv->id }}').click(function(e) {
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
                            '{{ route('admin.invoice.delete', ['id' => $inv->id]) }}';
                    }
                });
            });
        @endforeach
    </script>
@endsection
