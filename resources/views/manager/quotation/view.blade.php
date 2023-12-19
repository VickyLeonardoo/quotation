@extends('partials.manager.header')
@section('title','View Quotation')
@section('content')
<div class="row">
    <div class="col-9 col-lg-10 col-xl-9">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="page-pretitle">
                    Quotations
                </h6>
                <h4 class="page-title">Quotation #{{ $qto->quotationNo }}</h4>
            </div>
            <div class="col-auto">
                @if ($qto->status == 1)
                <a href="{{ route('manager.quotation.set.accepted',$qto->id) }}" class="btn btn-secondary ml-2">
                    Approve
                </a>
                @endif
                <a href="{{ route('manager.quotation.print',$qto->id) }}" class="btn btn-primary ml-2">
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
                                <p>{{ Carbon\Carbon::parse($qto->tglQuotation)->format('d M Y') }}</p>
                            </div>
                            <div class="col-md-4 info-invoice">
                                <h5 class="sub">Quotation No</h5>
                                <p>{{ $qto->quotationNo }}</p>
                                <h5 class="sub">Warranty</h5>
                                <p>{{ $qto->garansi }} {{ $qto->periode }}</p>
                            </div>
                            <div class="col-md-4 info-invoice">
                                <h5 class="sub">Quotation To</h5>
                                <p>
                                    {{ $qto->perusahaan->pic }}, {{ $qto->perusahaan->nama }}<br/>
                                    {{ $qto->perusahaan->alamat }}, <br/>
                                    {{ $qto->perusahaan->jalan1 }}
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
                                                    @foreach ($qto->produk as $data)
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
                                                        <td class="text-right">@currency($qto->total)</td>
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
                                <h5 class="sub">We really appreciate your business and if there's anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it's super easy since this is a template, so just ask!</h5>
                            </div>
                            <div class="col-sm-5 col-md-7 transfer-total">
                                <h5 class="sub">Total Amount</h5>
                                <div class="price">@currency($qto->total)</div>
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
                    @if ($qto->status == 0)
                    <span class="badge badge-info">Draft</span>
                    @elseif ($qto->status == 1)
                        Pending
                    @elseif ($qto->status == 2)
                        Accepted
                    @elseif ($qto->status == 3)
                        Confirmed
                    @elseif ($qto->status == 4)
                        Done
                    @else
                        Reject
                    <span class="badge badge-success">Selesai</span>
                    @endif
                </h5>
                <h5>
                    Email:
                    @if ($qto->is_email == true)
                        <input type="checkbox" checked readonly>
                    @else
                        <input type="checkbox" disabled>
                    @endif
                </h5>
            </div>
        </div>
    </div>
</div>


@endsection
