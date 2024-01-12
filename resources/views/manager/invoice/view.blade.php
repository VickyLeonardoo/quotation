@extends('partials.manager.header')
@section('title','View Invoice')
@section('content')
<div class="row">
    <div class="col-9 col-lg-10 col-xl-9">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="page-pretitle">
                    Invoices
                </h6>
                <h4 class="page-title">Invoice #{{ $inv->invoiceNo }}</h4>
            </div>
            <div class="col-auto">
                @if ($inv->status == 1)
                <a href="{{ route('manager.invoice.set.accepted',$inv->id) }}" class="btn btn-secondary ml-2">
                    Approve
                </a>
                @endif
                <a href="{{ route('manager.invoice.print',$inv->id) }}" target="_blank" class="btn btn-primary ml-2">
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
                                Quotation
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
                                <p>{{ Carbon\Carbon::parse($inv->tglInvoice)->isoFormat('D MMMM Y') }}</p>
                            </div>
                            <div class="col-md-4 info-invoice">
                                <h5 class="sub">Invoice No</h5>
                                <p>{{ $inv->invoiceNo }}</p>
                                <h5 class="sub">Payment Due</h5>
                                <p>{{ Carbon\Carbon::parse($inv->payment_due)->isoFormat('D MMMM Y') }}</p>

                            </div>
                            <div class="col-md-4 info-invoice">
                                <h5 class="sub">Invoice To</h5>
                                <p>
                                    {{ $inv->quotation->perusahaan->pic }}, {{ $inv->quotation->perusahaan->nama }}<br/>
                                    {{ $inv->quotation->perusahaan->alamat }}, <br/>
                                    {{ $inv->quotation->perusahaan->jalan1 }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-detail">
                                    <div class="invoice-top">
                                        <h3 class="title"><strong>Order summary</strong></h3>
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
                                                    @foreach ($inv->quotation->produk as $data)
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
                                                        <td class="text-right">@currency($inv->quotation->total)</td>
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
                                <h5 class="sub">{{ Riskihajar\Terbilang\Facades\Terbilang::make($inv->quotation->total) }}</h5>
                            </div>
                            <div class="col-sm-5 col-md-7 transfer-total">
                                <h5 class="sub">Total Amount</h5>
                                <div class="price">@currency($inv->quotation->total)</div>
                                <span>Taxes Included</span>
                            </div>
                        </div>
                        <div class="separator-solid"></div>
                        <h6 class="text-uppercase mt-4 mb-3 fw-bold">
                            Notes
                        </h6>

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
                    @if ($inv->status == 0)
                    <span class="badge badge-info">Draft</span>
                    @elseif ($inv->status == 1)
                        Pending
                    @elseif ($inv->status == 2)
                        Approved
                    @elseif ($inv->status == 3)
                        Confirmed
                    @elseif ($inv->status == 5)
                        Ditolak
                    @else
                    <span class="badge badge-success">Selesai</span>
                    @endif
                </h5>
            </div>
        </div>
        <h6 class="page-pretitle">
            Reject Note
        </h6>
        <div class="card">
            <div class="card-body">
                @if ($inv->log)
                    @foreach ($inv->log as $err)
                    <p style="font-size: 16px;"><strong>Manager:</strong> {{ $err->deskripsi }}</p>
                    <p class="mt--4 text-right" style="font-size: 10px;"><strong>{{ \Carbon\Carbon::parse($err->created_at)->diffForHumans() }}</strong></p>
                    <hr>
                    @endforeach
                @endif
            </div>
        </div>

        @if ($inv->status == 1)
        <div class="card">
            <div class="card-header">
                Reject Quotation
            </div>
            <form action="{{ route('manager.invoice.set.reject',$inv->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Deskripsi: </label>
                    <textarea name="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" rows="7"></textarea>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-danger" value="Reject">
                </div>
            </form>
        </div>
        @endif
    </div>
</div>

@endsection
