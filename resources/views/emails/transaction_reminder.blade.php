<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
</head>
<body>
    <h1>Just a little more, let's finish the payment.</h1>
    <p>Product Name: {{ $data->name }}</p>
    <p>Total: Rp. {{ number_format($data->amount,0,",",".") }} </p>
    <p>Please transfer to 0123456789XXX</p>
    <p>Thank you.</p>
</body>
</html>
