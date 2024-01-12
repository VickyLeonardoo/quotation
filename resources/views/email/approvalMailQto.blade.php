<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h5>Manager, ada Quotation yang butuh untuk di approve!</h5><br>
    Quotation NO: <strong>{{ $qto->quotationNo }}</strong>
    <br>
    <a href="{{ url('manager/quotation/'.$qto->id.'/view') }}">CEK</a>
</body>
</html>
