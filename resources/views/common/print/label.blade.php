<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Label</title>
    <style>
        @page { margin:0mm; padding:0mm;  }
        * { margin:0mm; padding:0mm; font-family: sans-serif; }

        .outer { width: 95mm; height: 70mm;  margin: 2mm; border: 0.5mm solid #000000; }

        /* 68mm we have to devide in 4 boxes */

        /* 10mm */
        .header { border-bottom: 0.5mm solid #000000; padding: 2mm; height: 5mm; }
        
        /* 38.5 mm */
        .address { border-bottom: 0.5mm solid #000000; padding: 2mm; height: 29.5mm; }
        
        /* 15mm */
        .order { border-bottom: 0.5mm solid #000000; padding: 2mm; height: 12.5mm; }

        /* 10mm */
        .payment { padding: 2mm; height: 5mm; }

        .fr { display:inline-block; float:right; }
        
        .fs-1 { font-size: 3.5mm; line-height:3.5mm; }
        .fs-2 { font-size: 4mm; line-height:4mm; }
        .fs-3 { font-size: 5mm; line-height:5mm; }

        .fw-bold { font-weight:bold; }
        .fw-normal { font-weight:normal; }

        .mb-1{ margin-bottom: 1mm; display:block; }

    </style>
</head>
<body>
    <div class="outer">

        <!-- Header of Label -->
        <div class="header">
            <span class="fs-3 fw-bold">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($logo))) }}" style="width:20px; vertical-align:top;">
                {{$app_name}}
            </span>
        </div>

        <div class="address">
            <span class="fs-2 fw-bold mb-1">{{$order->address->name}}</span>
            <span class="fs-1 fw-normal">{{$order->address->address}} {{$order->address->city}} {{$order->address->pincode}} {{$order->address->state}} {{$order->address->country}} <br>
            {{$order->address->mobile}} - {{$order->address->email}}</span>
        </div>

        <div class="order">
            {!! $barcode !!}
            <span class="fs-2">{{$order->id}}</span>
            <span class="fs-2 fr">{{ date("d-m-Y", strtotime($order->created_at)) }}</span>
        </div>

        <div class="payment">
            <span class="">Rs {{$order->payable}}/-</span>
            <span class="fr">{{$order->paymentmode}}</span>
        </div>

        <!-- <div style="clear:both;"></div> -->

        <!-- <h1>{{$order->id}} {{$order->address->name}}</h1> -->

    </div>
</body>
</html>