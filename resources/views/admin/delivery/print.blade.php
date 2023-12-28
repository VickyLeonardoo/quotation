<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Order</title>
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
            font-weight: bold;
            ;
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
            margin-top: 0.5cm;
        }
        .kalimatPembuka1 {
            font-size: 16px;
            font-family: 'Calibri';
            margin-left: 6cm;
            position: absolute;
            font-weight: bold;
        }
        .kalimatPembuka2 {
            font-size: 16px;
            font-family: 'Calibri';
            margin: 2px;
            font-weight: bold;
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
    <H3 class="quotationTitle">Delivery Order</H3>

    <table>
        <tr style="width: 100%;">
            <td style="width: 10%; border: none;">
                To
                <br>
                <br>
                Ship To<br>
                <br>
                <br>
                Attn
                <br>
                CC
                <br>
                Telp
                <br>
                Fax
            </td>
            <td style="width: 44%;  border: none;">:
                Panasonic Industrial Devices Singapore Pte. Ltd <br>
                &nbsp;&nbsp;3 Bedok South Road Singapore 469269 <br>

                : Panasonic Industrial Devices Batam <br>
                &nbsp;&nbsp;Puri Industri Park 2000, Batam <br>
                &nbsp;&nbsp;Kelurahan Baloi Permai, 29463,Batam <br>

                : Ms. Tiona/MS. Susmaida <br>
                : Ms. Tuty/MS. Chong <br>
                : 778465050 <br>
                : -
            </td>
            <td style="width: 10%; border-right: none">
            <strong>
                No <br><br>
                Date <br><br>
                PO/NO <br><br>
                Ordered BY <br><br>
                <br>
            </strong>
            </td>
            <td style="width: 36%; border-left: none">
            <strong>
                : {{ $do->deliveryNo }} <br><br>
                : {{ $do->tglDelivery }} <br><br>
                : {{ $do->purchaseNo }} <br><br>
                : DO2212122 <br><br>
                <br>
            </strong>
            </td>
        </tr>

    </table>

    <div style="margin-top: 1cm">

    </div>
    <table>
        <thead style="background-color: #bfbfbf;">
            <tr>
                <th style="width: 2%;">NO</th>
                <th style="width: 45%;">DESCRIPTION</th>
                <th style="width: 20%;">QTY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($do->invoice->quotation->produk as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: left;">{{ $data->namaProduk }}</td>
                <td style="text-align: center;">{{ $data->pivot->quantity }}</td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr><tr>
                <td></td>
                <td></td>
                <td></td>
            </tr><tr>
                <td></td>
                <td></td>
                <td></td>
            </tr><tr>
                <td></td>
                <td></td>
                <td></td>
            </tr><tr>
                <td></td>
                <td></td>
                <td></td>
            </tr><tr>
                <td></td>
                <td></td>
                <td></td>
            </tr><tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
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
                <p class="kalimatPembuka2">Signature</p>
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
                <p class="kalimatPembuka2">Authorized Signature</p>
            </td>
        </tr>
    </table>



</body>

</html>
