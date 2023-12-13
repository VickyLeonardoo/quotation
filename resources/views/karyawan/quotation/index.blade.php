@extends('partials.karyawan.header')

@section('title', 'Quotation')

@section('content')
    <div class="row">
        <div class="container">
            <div class="page-inner page-inner-tab-style">
                <div class="page-header">
                    <h3>Daftar Quotation</h3>
                </div>
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Quotation</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotations as $qto)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $qto->quotationNo}}</td>
                                <td>{{ $qto->perusahaan->nama }}</td>
                                <td bgcolor="{{ $qto->status == 1 ? '#cde8ff':'#85ff7c' }}">{{ $qto->status == 1 ? 'Proses':'' }}</td>
                                <td style="width: 10%">
                                    <a href="" class="btn btn-info"><i class="fas fa-info"></i>  Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
