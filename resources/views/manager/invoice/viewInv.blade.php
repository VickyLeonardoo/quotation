@extends('partials.manager.header')

@section('title', Route::is('manager.invoice.draft') ? 'Invoice Draft':'Invoice Confirmed')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <a href="{{ url('manager/invoice-draft/create') }}" class="btn btn-info">Tambah</a>
                        <div class="card-category"></div>
                        <h4 class="page-title">Daftar Invoice</h4>
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
                                @foreach ($invoices as $inv)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $inv->quotation->quotationNo }}</td>
                                    <td>{{ $inv->quotation->perusahaan->nama }}</td>
                                    <td>{{ Carbon\Carbon::parse($inv->quotation->tglQuotation)->format('d-M-Y') }}</td>
                                    <td>
                                        <a href="{{ route('manager.invoice.view',$inv->id) }}" title="Quotation" class="btn btn-info"><i class="fas fa-file-invoice"></i></a>
                                        <button type="button" class="btn btn-danger" title="Hapus" id="alert_demo_8"><i class="fas fa-trash"></i></button>
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
