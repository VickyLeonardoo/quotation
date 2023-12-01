<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Quotation|{{ $inv->invoiceNo }}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('atlantis') }}/assets/img/icon.ico" type="image/x-icon" />
    <!-- Fonts and icons -->

    <script src="{{ asset('atlantis') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('atlantis') }}/assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('atlantis') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('atlantis') }}/assets/css/atlantis.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        @media print {
            tr:nth-child(even) td {
                background-color: #F2F2F2 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body data-background-color="bg2">
    <div class="col-12 col-lg-12 col-xl-12">
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
                                <p>{{ Carbon\Carbon::parse($inv->tglInvoice)->isoFormat('d MMMM Y') }}</p>
                            </div>
                            <div class="col-md-4 info-invoice">
                                <h5 class="sub">Invoice No</h5>
                                <p>{{ $inv->invoiceNo }}</p>
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
    <script>
        window.addEventListener("load", window.print());
    </script>
    @include('partials.admin.script')
</body>

</html>
