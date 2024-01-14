<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 60px;
        }

        header {
            text-align: center;
        }

        .namaPerusahaan {
            font-size: 48px;
            margin: -2px;
            color: #ff0000;
            font-family: 'Algerian';
        }

        .fixture {
            font-size: 12px;
            margin: -2px;
            font-weight: bold;
        }

        .kiri {
            align-items: center;
        }

        #logo {
            width: 140px;
            height: 85px;
            margin-bottom: 10px;
            margin-top: 2cm;
            position: absolute;
        }

        h2 {
            margin: 2px 0;
        }

        h5 {
            margin: 2px;
            margin-left: 4cm;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: left;
        }

        hr {
            border: 1px solid black;
            margin-top: 10px;
        }

        .quotationTitle {
            text-align: center;
            margin-top: -2px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(1, 1fr) repeat(7, 1fr) repeat(1, 1fr) repeat(3, 1fr);
            grid-gap: 10px;
            margin-top: -50px;
            padding-top: 20px;
        }

        .grid-item {
            padding-top: 20px;
            text-align: center;
        }

        .grid-left {
            color: black;
            grid-column: span 1;
            justify-content: left;
        }

        .grid-left2 {
            color: black;
            grid-column: span 7;
            justify-content: left;
        }

        .grid-center-right-container {
            display: flex;
            border: 2px solid black;
            /* Atur border sesuai kebutuhan */
            grid-column: span 4;
            /* 1 (grid-center) + 4 (grid-right) */
            align-self: center;
            margin-top: 10px;
        }

        .grid-center {
            color: black;
            flex: 1;
            /* Biarkan flex item mengisi sisa ruang yang tersedia */
            justify-self: left;
            text-align: center;
            /* Sesuaikan dengan kebutuhan */
            margin-top: -18px;

        }

        .grid-right {
            color: black;
            justify-self: center;
            flex: 1;
            /* Biarkan flex item mengisi sisa ruang yang tersedia */
            text-align: center;
            /* Sesuaikan dengan kebutuhan */
            margin-top: -18px;
        }


        .penerima {
            font-size: 12px;
            text-align: left;
            margin: 2px;
        }

        .qtoNo {
            font-size: 10px;
            text-align: left;
            margin: 5px;
        }

        .kalimatPembuka {
            font-size: 16px;
            font-family: 'Calibri';
            margin: 2px;
        }

        .textPembuka {
            margin-top: 30px;
        }

        .textPenutup {
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th {
            border: 2px solid black;
            padding: 8px;
        }

        td {
            padding: 8px;
            border: 2px solid black;
        }


        th {
            text-align: center;
        }

        /* Sesuaikan lebar kolom sesuai permintaan */
        th:nth-child(1) {
            width: 5%;
        }

        th:nth-child(2) {
            width: 30%;
        }

        th:nth-child(3) {
            width: 20%;
        }

        th:nth-child(4) {
            width: 5%;
        }

        th:nth-child(5) {
            width: 5%;
        }

        th:nth-child(6) {
            width: 15%;
        }

        th:nth-child(7) {
            width: 20%;
        }
    </style>
</head>

<body>
    <img src="{{asset ('assets/gmp.png')}}" alt="Company Logo" id="logo">
    <header>
        <p class="namaPerusahaan">CV. Gabril Mitra Perkasa</p>
        <P class="fixture">JIG & FIXTURE &#8226; FABRICATION &#8226; MECHANICAL &#8226; ELECTRICAL &#8226; GENERAL
            ENGINEERING <br>
            GENERAL TRADING &#8226; GENERAL SERVICE </P>
        <h5>Office: Perum. HMP Blok D No. 6, Kel.Duriangkang, Kec Sungai Beduk - Batam </h5>
        <h5 class="kiri">Workshop: Ruko Alexandria Blok B No. 42 - Batam </h5>
        <h5 class="kiri">Contact Phone: (+62) 812-6756-7765, (+62)821-7034-7775</h5>
        <h5 class="kiri">Nomor HP: 08123456789 | Email: info@perusahaan.com</h5>
    </header>
    <hr>
    <H3 class="quotationTitle">INVOICE</H3>

    <!-- <div class="grid-container">
        <div class="grid-item grid-left">
            <p class="penerima"><strong>To</strong></p>
            <p class="penerima"><strong><br></strong></p>
            <p class="penerima"><strong><br></strong></p>
            <p class="penerima"><strong>Attn</strong></p>
            <p class="penerima"><strong>Phone</strong></p>
            <p class="penerima"><strong>Fax</strong></p>
        </div>
        <div class="grid-item grid-left2">
            <p class="penerima">: PANASONIC INDUSTRIAL DEVICES SINGAPORE PTE. LTD.</p>
            <p class="penerima"> &nbsp;&nbsp;Kepulauan Riau, Batam.</p>
            <p class="penerima"> &nbsp;&nbsp;Jalan 1, Jalan 2, Jalan 3</p>
            <p class="penerima">: MR. Yow Hock Thor</p>
            <p class="penerima">: -</p>
            <p class="penerima">: -</p>
        </div>
        <div class="grid-item grid-center-right-container">
            <div class="grid-center">
                <p class="qtoNo">NO</p>
                <p class="qtoNo">DATE</p>
                <p class="qtoNo">PAYMENT</p>
                <p class="qtoNo">VALIDITY</p>
                <p class="qtoNo">DELIVERY</p>
                <p class="qtoNo">WARRANTY</p>
            </div>
            <div class="grid-right">
                <p class="qtoNo">: NO</p>
                <p class="qtoNo">: DATE</p>
                <p class="qtoNo">: PAYMENT</p>
                <p class="qtoNo">: VALIDITY</p>
                <p class="qtoNo">: DELIVERY</p>
                <p class="qtoNo">: WARRANTY</p>
            </div>
        </div>
    </div> -->

    <table>
        <tr style="width: 100%;">
            <td style="width: 10%; border:none;">
                <strong>Bill To</strong>
                <br>
                <br>
                <br>
                <br>
                <br>
                <strong>Ship To</strong> <br>
                <br>
                <br>
                <br>
            </td>
            <td style="width: 53%; border-left:none; border:none;">
                : {{ $inv->quotation->perusahaan->nama }} <br>
                &nbsp;&nbsp;{{ $inv->quotation->perusahaan->provinsi }}, {{ $inv->quotation->perusahaan->kota }},<br>
                <br>
                <br>
                <br>
                : {{ $inv->quotation->perusahaan->nama }}<br>
                &nbsp;&nbsp;{{ $inv->quotation->perusahaan->alamat }} <br>
                &nbsp;&nbsp;{{ $inv->quotation->perusahaan->jalan1 }} <br>
                &nbsp;&nbsp;{{ $inv->quotation->perusahaan->jalan2 }}
            </td>

            <td style="width: 18%; border-top: 2px solid black; border-bottom: 2px solid black; border-right: none;">
                DATE <br><br>
                P.O.No <br><br>
                D.O. No <br><br>
                Terms Of Payment <br><br>
            </td>
            @php
            // Hitung jarak antara tglInvoice dan payment_due
                $tglInvoice = Carbon\Carbon::parse($inv->tglInvoice);
                $paymentDue = Carbon\Carbon::parse($inv->payment_due);
                $jarakHari = $tglInvoice->diffInDays($paymentDue);
            @endphp
            <td style="width: 19%;border-top: 2px solid black; border-bottom: 2px solid black; border-left: none;">
                : {{ Carbon\Carbon::parse($inv->tglInvoice)->format('d M Y') }} <br>

                : {{ $inv->quotation->purchaseNo }} <br><br>
                : {{ $inv->quotation->quotationNo }} <br><br>
                : {{ $jarakHari }} Days<br><br>
            </td>
        </tr>

    </table>

    <div class="textPembuka">
        <p class="kalimatPembuka">Dear Sir / Madam,</p>
        <p class="kalimatPembuka">We are pleaset to quote you as follows,</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 2%;">NO</th>
                <th style="width: 45%;">DESCRIPTION</th>
                <th style="width: 15%;">UNIT PRICE</th>
                <th style="width: 10%;">QTY</th>
                <th style="width: 25%;">AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inv->quotation->produk as $data)
            <?php
            $totalHarga = 0;
            $totalHarga += $data->pivot->harga * $data->pivot->quantity;
            ?>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->namaProduk }}</td>
                <td>@currency($data->pivot->harga) </td>
                <td style="text-align: center;">{{ $data->pivot->quantity }}</td>
                <td style="text-align: right;">@currency($data->pivot->harga * $data->pivot->quantity)</td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center; border-left:none; border-bottom: none;"></td>
                <td style="text-align: left; border-right: none;">Total</td>
                <td style="text-align: center; border-left: none;">: @currency($totalHarga)</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center; border-left:none; border-bottom: none; border-top:none;">
                </td>
                <td style="text-align: left; border-right: none">Sub Total</td>
                <td style="text-align: center; border-left: none">: @currency($totalHarga)</td>
            </tr>
        <tfoot>
            <tr></tr>
        </tfoot>
        </tbody>

    </table>

    <br>
    <table>
        <tr>
            <td style="text-align: center; border: none;">
                <p style="font-size: 12px;" class="kalimatPembuka"><strong>RECEIVED BY,</strong></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class="kalimatPembuka">(................................)</p>
            </td>
            <td style="text-align: center; border: none;">
                <p style="font-size: 12px;" class="kalimatPembuka"><strong>CV. GABRIL MITRA PERKASA</strong></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class="kalimatPembuka">(................................)</p>
            </td>
        </tr>
    </table>

</body>
<script>
    window.addEventListener("load", window.print());
</script>
</html>
