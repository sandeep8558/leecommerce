<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Product Label</title>
    <style>
        @page { margin:0mm; padding:0mm;  }
        * { margin:0mm; padding:0mm; font-family: sans-serif; }
        .outer { width: 35mm; height: 13mm; margin: 1mm auto; text-align:center; }

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

        .mx-auto { margin-left:auto; margin-right:auto; }
        .fs-2-5 { font-size: 2.5mm; line-height:2.5mm; }

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
    <div class="outer fs-2-5">
        <div class="mb-1">{{$product->data_product_group}}</div>
        <div class="mb-1">
            <img class="h-5" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($barcode))) }}" style="vertical-align:middle;">
        </div>
        <div>{{$product->id}}</div>
    </div>
</body>
</html>