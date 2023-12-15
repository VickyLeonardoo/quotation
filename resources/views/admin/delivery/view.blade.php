@extends('partials.admin.header')
@section('title','View Delivery Order')
@section('content')
<div class="row">
    <div class="col-9 col-lg-10 col-xl-9">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="page-pretitle">
                    Invoices
                </h6>
                <h4 class="page-title">Invoice #{{ $do->deliveryNo }}</h4>
            </div>
            <div class="col-auto">
                {{-- @if ($inv->status == 0)
                <a href="{{ route('admin.invoice.set.confirm',$inv->id) }}" class="btn btn-secondary ml-2">
                    Konfirmasi
                </a>
                @elseif ($inv->status == 1)
                <a href="{{ route('admin.invoice.set.selesai',$inv->id) }}" class="btn btn-success ml-2">
                    Selesai
                </a>
                @endif --}}
                <a href="{{ route('admin.invoice.print',$do->id) }}" target="_blank" class="btn btn-primary ml-2">
                   <i class="fas fa-print"></i> Print
                </a>
            </div>
        </div>
        <div class="page-divider"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-invoice">
                    <div class="card-header">
                        <div class="invoice-header">
                            <h3 class="invoice-title">
                                Delivery Order
                            </h3>
                            <div class="invoice-logo">
                                {{-- <img src="../assets/img/examples/logoinvoice.svg" alt="company logo"> --}}
                            </div>
                        </div>
                        <div class="invoice-desc">
                            {{ $cv->kota }}, {{ $cv->provinsi }}, Indonesia<br/>
                            {{-- {{ $cv->alamat }}<br/> --}}
                            {{ $cv->jalan1 }}<br/>
                            {{ $cv->jalan2 }}<br/>
                            {{ $cv->jalan3 }}<br/>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="separator-solid"></div>
                        <div class="row">
                            <div class="col-md-4 info-invoice">
                                <h5 class="sub">Date</h5>
                                <p>{{ Carbon\Carbon::parse($do->tglDelivery)->isoFormat('d MMMM Y') }}</p>
                            </div>
                            <div class="col-md-4 info-invoice">
                                <h5 class="sub">Invoice No</h5>
                                <p>{{ $do->invoice->invoiceNo }}</p>
                            </div>
                            <div class="col-md-4 info-invoice">
                                <h5 class="sub">Shipping To</h5>
                                <p>
                                    {{ $do->invoice->quotation->perusahaan->pic }}, {{ $do->invoice->quotation->perusahaan->nama }}<br/>
                                    {{ $do->invoice->quotation->perusahaan->alamat }}, <br/>
                                    {{ $do->invoice->quotation->perusahaan->jalan1 }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-detail">
                                    <div class="invoice-top">
                                        <h3 class="title"><strong>Item</strong></h3>
                                    </div>
                                    <div class="invoice-item">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Item</strong></td>
                                                        <td class="text-center"><strong>Price</strong></td>
                                                        <td class="text-center"><strong>Quantity</strong></td>
                                                        <td class="text-right"><strong>Totals</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($do->invoice->quotation->produk as $data)
                                                    <tr>
                                                        <td>{{ $data->namaProduk }}</td>
                                                        <td class="text-center">@currency($data->pivot->harga) </td>
                                                        <td class="text-center">{{ $data->pivot->quantity }}</td>
                                                        <td class="text-right">@currency($data->pivot->harga * $data->pivot->quantity)</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center"><strong>Total</strong></td>
                                                        <td class="text-right">@currency($do->invoice->quotation->total)</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator-solid  mb-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-7 col-md-5 mb-3 mb-md-0 transfer-to">
                                <h5 class="sub">{{ Riskihajar\Terbilang\Facades\Terbilang::make($do->invoice->quotation->total) }}</h5>
                            </div>
                            <div class="col-sm-5 col-md-7 transfer-total">
                                <h5 class="sub">Total Amount</h5>
                                <div class="price">@currency($do->invoice->quotation->total)</div>
                                <span>Taxes Included</span>
                            </div>
                        </div>
                        <div class="separator-solid"></div>
                        <h6 class="text-uppercase mt-4 mb-3 fw-bold">
                            Notes
                        </h6>
                        Barang yang rusak akan memiliki garansi 3 bulan sesuai dengan segel yang ada pada unit.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 ">
        <div class="text-right">
            <button onclick="history.back()" class="btn btn-info">Kembali</button>
        </div>
        <div class="row align-items-center">
            <div class="col">
                <h6 class="page-pretitle">
                    Log Note
                </h6>
            </div>
            <div class="col-auto">
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>Status:
                    @if ($do->status == 0)
                    <span class="badge badge-info">Draft</span>
                    @elseif ($inv->status == 1)
                        Konfirmasi
                    @else
                    <span class="badge badge-success">Selesai</span>
                    @endif
                </h5>
            </div>
        </div>
    </div>
</div>

@endsection
