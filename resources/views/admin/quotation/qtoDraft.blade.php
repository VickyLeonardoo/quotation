@extends('partials.admin.header')

@section('title', Route::is('admin.quotation.draft') ? 'Quotation Draft':'Quotation Confirmed')

@section('content')
    <div class="row">
        <div class="col-md-12">
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
                                    <td>
                                        <a href="{{ route('admin.quotation.view',$qto->id) }}" title="Quotation" class="btn btn-info"><i class="fas fa-file-invoice"></i></a>
                                        <a href="#" title="Edit" class="btn btn-info"><i class="fas fa-edit"></i></a>
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
