<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

use Barryvdh\DomPDF\Facade\Pdf;
use DNS2D;
use DNS1D;

class CommonController extends Controller
{
    public function product($id){
        $product = Product::find($id);
        $barcode = DNS1D::getBarcodePNGPath($id, 'C39', 2, 25);
        
        $data = [
            "product" => $product,
            "barcode" => $barcode
        ];

        $width = 35;
        $height = 15;

        $customPaper = array(0,0,$this->mm2pt($width),$this->mm2pt($height));
        $pdf = Pdf::loadView('common.print.product', $data)->setPaper($customPaper, 'portrait');
        return $pdf->stream('OID-'.$id.'.pdf');
    }

    protected function mm2pt($mm){
        return $mm / 25.4 * 72;
    }
}
