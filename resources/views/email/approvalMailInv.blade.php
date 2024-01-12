<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h5>Direktur, ada Quotation yang butuh untuk di approve!</h5><br>
Quotation NO: <strong>{{ $inv->invoiceNo }}</strong>
<a href="{{ url('manager/invoice/'.$inv->id.'/view') }}">CEK</a>
</body>
</html>
