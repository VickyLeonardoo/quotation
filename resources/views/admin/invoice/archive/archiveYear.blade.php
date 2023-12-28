@extends('partials.admin.header')

@section('title', ' Archive '.$year)

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
                <form action="{{ url('/admin/invoice/archive/'.$year) }}">
                    @csrf
                    <span>Filter Tanggal</span><br><br>
                    <div class="form-row">
                        <div class="col-3">
                            <input type="text" class="form-control flatpickr-input" name="mulai"
                                placeholder="Tanggal Mulai" id="mulai"
                                value="{{ request('mulai') }}" onfocus="(this.type='date')">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" name="akhir" placeholder="Tanggal Akhir"
                                id="akhir" value="{{ request('akhir') }}"
                                onfocus="(this.type='date')">
                        </div>
                        <div>
                            <button type="submit" id="search" class="form-control btn btn-primary"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="container-fluid">
                    <div class="card-category"></div>
                    {{-- <h4 class="page-title">Archive Quotation {{ $year }}</h4> --}}
                </div>
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice No</th>
                                <th>Quotation No</th>
                                <th>Nama Perusahaan</th>
                                <th>Tanggal</th>
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
                                <td>{{ Carbon\Carbon::parse($inv->tglQuotation)->format('d-M-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.invoice.view',$inv->id) }}" title="Quotation" class="btn btn-info"><i class="fas fa-file-invoice"></i></a>
                                    <a href="{{ route('admin.invoice.unarchive',$inv->id) }}" title="Unarchive" class="btn btn-secondary"><i class="fas fa-archive"></i></a>
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
