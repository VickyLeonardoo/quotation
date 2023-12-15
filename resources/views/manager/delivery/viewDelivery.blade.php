@extends('partials.manager.header')

@section('title', Route::is('manager.delivery.draft') ? 'Delivery Draft' : 'Delivery Confirmed')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        {{-- <a href="{{ url('manager/delivery-draft/create') }}" class="btn btn-info">Tambah</a> --}}
                        <div class="card-category"></div>
                        <h4 class="page-title">Daftar Delivery</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deliveries as $delivery)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $delivery->invoice->invoiceNo }}</td>
                                        <td>{{ $delivery->invoice->quotation->quotationNo }}</td>
                                        <td>{{ Carbon\Carbon::parse($delivery->tglDelivery)->format('d-M-Y') }}</td>
                                        <td>
                                            <a href="{{ route('manager.invoice.view', $delivery->id) }}" title="Quotation"
                                                class="btn btn-info"><i class="fas fa-file-invoice"></i></a>
                                            <a href="{{ route('manager.delivery.draft.edit', $delivery->id) }}"
                                                title="Edit Delivery" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger" title="Hapus"
                                                id="alertDelete_{{ $delivery->id }}"><i class="fas fa-trash"></i></button>
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
        @foreach ($deliveries as $delivery)
            $('#alertDelete_{{ $delivery->id }}').click(function(e) {
                swal({
                    title: 'Hapus Delivery?',
                    text: "Data Delivery Order akan dihapus!",
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
                            '{{ route('manager.delivery.draft.delete', ['id' => $delivery->id]) }}';
                    }
                });
            });
        @endforeach
    </script>
@endsection
