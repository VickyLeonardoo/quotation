<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 25px;
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
            margin-top: 16px;
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

        th{
            border: 2px solid black;
            padding: 8px;
        }
        td{
            padding: 8px;
            border: 2px solid black;
            border-top: none;
            border-bottom: none;
        }


        th {
            background-color: #dbe5f2;
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
    {{-- <img src="{{asset ('assets/gmp.png')}}" alt="" id="logo"> --}}
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
    <H3 class="quotationTitle">QUOTATION</H3>
    <table>
        <tr style="width: 100%;">
            <td style="width: 8%; border-top:none; border-left:none; border-right:none;">
                <strong>To</strong>
                <br>
                <br>
                <strong>Attn</strong> <br>
                <strong>Phone</strong> <br>
                <strong>Fax</strong> <br>
            </td>
            <td style="width: 58%; border-left:none; border-right:none;">: {{ $qto->perusahaan->nama }} <br>
               {{-- &nbsp;&nbsp;{{ $qto->perusahaan->provinsi }}, {{ $qto->perusahaan->kota }},<br> --}}
               &nbsp;&nbsp;{{ $qto->perusahaan->c_alamat }}, {{ $qto->perusahaan->c_jalan1 }}, {{ $qto->perusahaan->c_jalan2 }}
                <br>
                 : {{ $qto->perusahaan->pic }}<br>
                 : {{ $qto->perusahaan->noTelp }}<br>
                : {{ $qto->perusahaan->fax }}<br>
            </td>

            <td style="width: 15%; border-top: 2px solid black; border-bottom: 2px solid black; border-right: none;">
                NO <br>
                DATE <br>
                WARRANTY <br>
                <br>
                <br>
                <br>
            </td>
            <td style="width: 19%;border-top: 2px solid black; border-bottom: 2px solid black; border-left: none;">
                : {{ $qto->quotationNo }} <br>
                : {{ $qto->tglQuotation }}<br>
                : {{ $qto->garansi }} {{ $qto->periode }} <br>
                <br>
                <br>
                <br>

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
                <th>NO</th>
                <th>DESCRIPTION</th>
                <th>BRANDS</th>
                <th>UOM</th>
                <th>QTY</th>
                <th>PRICE</th>
                <th>AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($qto->produk as $data)
            <?php
            $totalHarga = 0;
            $totalHarga += $data->pivot->harga * $data->pivot->quantity;
            ?>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->namaProduk }}</td>
                <td>@if ($data->uom == 'Jasa')
                    -
                    @else
                    {{ $data->brands }} </td>
                @endif
                <td style="text-align: center;"> {{ $data->uom }} </td>
                <td style="text-align: center;">{{ $data->pivot->quantity }}</td>
                <td style="text-align: center;">@currency($data->pivot->harga)</td>
                <td style="text-align: right;">@currency($data->pivot->harga * $data->pivot->quantity)</td>
            </tr>
            @endforeach
            <tr>
                <td style="height: 150px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
              <td style="border-bottom: 2px solid black;"></td>
              <td style="border-bottom: 2px solid black;"></td>
              <td style="border-bottom: 2px solid black;"></td>
              <td colspan="3" style="border-top: 2px solid black; border-bottom: 2px solid black; border-right: none;">TOTAL</td>
              <td colspan="1" style="text-align: right; border-top: 2px solid black; border-bottom: 2px solid black; border-left: none;">@currency($qto->total)</td>
            </tr>
          </tfoot>
    </table>
    <div class="textPenutup">
        <p class="kalimatPembuka">We hope that above quote is acceptable to you and looking forward to receive your early,</p>
        <p class="kalimatPembuka">confirmation</p>
    </div>
    <br>
    <p class="kalimatPembuka">Customer Confirmation</p>

    <br>
    <br>
    <br>
    <br>
    <p class="kalimatPembuka">Signature, Date & Stamp</p>


</body>
</html>
