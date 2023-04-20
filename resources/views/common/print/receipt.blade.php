<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Receipt</title>
    <style>
        @page { margin:0mm; padding:0mm;  }
        * { margin:0mm; padding:0mm; font-family: sans-serif; }
        .outer { width: 74mm; height: 70mm;  margin: 3mm; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight:bold; }
        .fw-normal { font-weight:normal; }

        <?php
            for($i=0; $i < 10; $i++){
                echo ".p-".$i."{padding:".$i."mm;}";
                echo ".pt-".$i."{padding-top:".$i."mm;}";
                echo ".pb-".$i."{padding-bottom:".$i."mm;}";
                echo ".pl-".$i."{padding-left:".$i."mm;}";
                echo ".pr-".$i."{padding-right:".$i."mm;}";
                echo ".px-".$i."{padding-right:".$i."mm;padding-left:".$i."mm;}";
                echo ".py-".$i."{padding-top:".$i."mm;padding-bottom:".$i."mm;}";

                echo ".m-".$i."{margin:".$i."mm;}";
                echo ".mt-".$i."{margin-top:".$i."mm;}";
                echo ".mb-".$i."{margin-bottom:".$i."mm;}";
                echo ".ml-".$i."{margin-left:".$i."mm;}";
                echo ".mr-".$i."{margin-right:".$i."mm;}";
                echo ".mx-".$i."{margin-right:".$i."mm;margin-left:".$i."mm;}";
                echo ".my-".$i."{margin-top:".$i."mm;margin-bottom:".$i."mm;}";

                echo ".fs-".$i."{font-size:".$i."mm;line-height:".$i."mm;}";
            }

            for($i=0; $i < 100; $i++){
                echo ".w-".$i."{width:".$i."%;}";
                echo ".h-".$i."{height:".$i."mm;}";
            }
        ?>

        table { width: 100%; border-collapse: collapse; }

        .border-0 { border: 0mm solid #000000; }
        .border { border: 0.2mm solid #000000; }
        .border-x { border-left: 0.2mm solid #000000; border-right: 0.2mm solid #000000; }
        .border-y { border-top: 0.2mm solid #000000; border-bottom: 0.2mm solid #000000; }
        .border-t { border-top: 0.2mm solid #000000; }
        .border-b { border-bottom: 0.2mm solid #000000; }
        .border-l { border-left: 0.2mm solid #000000; }
        .border-r { border-right: 0.2mm solid #000000; }


    </style>
</head>
<body>

   

    <div class="outer">

        <table class="my-0 mt-3 border-0">
            <tr>
                <td class="py-1 fs-5 text-center">{{$app_name}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-2 fs-3 text-center">{{$address}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">{{$support_email}}</td>
                <td class="py-1 fs-3 text-right">{{$support_mobile}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">ORDER: {{$order->id}}</td>
                <td class="py-1 fs-3 text-right">Date:{{ date("d-m-Y", strtotime($order->created_at)) }}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-2 fs-3">Delivery Address: <br>{{$address}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">{{$order->address->email}}</td>
                <td class="py-1 fs-3 text-right">{{$order->address->mobile}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3 fw-bold">PARTICULAR</td>
                <td class="w-18 text-center py-1 fs-3 fw-bold">QTY</td>
                <td class="w-18 text-right py-1 fs-3 fw-bold">RATE</td>
                <td class="w-18 text-right py-1 fs-3 fw-bold text-right">AMT</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            @foreach($order->order_data as $od)
            <tr>
                <td class="h-8 fs-3">{{$od->group_name}}</td>
                <td class="w-10 text-center h-8 fs-3">{{$od->qty}}</td>
                <td class="w-20 text-right h-8 fs-3">{{$od->rate}}</td>
                <td class="w-20 text-right h-8 fs-3 text-right">{{$od->rate_total}}</td>
            </tr>
            @endforeach
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">MRP Total</td>
                <td class="py-1 fs-3 text-right">{{$order->mrp_total}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">Cost Total</td>
                <td class="py-1 fs-3 text-right">{{$order->cost_total}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">Tax Total</td>
                <td class="py-1 fs-3 text-right">{{$order->tax_total}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">Rate Total</td>
                <td class="py-1 fs-3 text-right">{{$order->rate_total}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">Discount</td>
                <td class="py-1 fs-3 text-right">{{$order->discount}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">Offer Discount</td>
                <td class="py-1 fs-3 text-right">{{$order->offer_discount}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">Delivery</td>
                <td class="py-1 fs-3 text-right">{{$order->delivery}}</td>
            </tr>
        </table>

        <table class="my-0 border-b">
            <tr>
                <td class="py-1 fs-3">Payable Amount</td>
                <td class="py-1 fs-3 text-right fw-bold">{{$order->payable}}</td>
            </tr>
        </table>


        <table class="my-0 border-0">
            <tr>
                <td class="pt-4 fs-5 text-center">Thank you!</td>
            </tr>
        </table>

    </div>
</body>
</html>