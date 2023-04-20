<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\OrderData;

class ProductSale extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($what='Day', $typ='line', $duration=0, $page=1, $product_id=1)
    {
        parent::__construct();

        $today = date("Y-m-d");

        switch($what){
            
            case "Day":
            $labels = [];
            $data = [];
            $duration = $duration == 0 ? 7 : $duration;
            $s = (($duration * $page)-$duration);
            $l = $duration * $page;
            for($i=$s;$i<$l;$i++){
                $d = $i == 0 ? 'Day' : 'Days';
                $labels[] = $dt = date('Y-m-d', strtotime('-'.$i.' '.$d, strtotime($today)));
                $data[] = OrderData::
                whereHas('order', function($q) {
                    $q->where('orderstatus', 'Success');
                })
                ->where('product_id', $product_id)->whereDate('created_at', $dt)->sum('rate_total');
            }
            break;

            case "Month":
            $labels = [];
            $data = [];
            $duration = $duration == 0 ? 6 : $duration;
            $s = (($duration * $page)-$duration);
            $l = $duration * $page;
            for($i=$s;$i<$l;$i++){
                $d = $i == 0 ? 'Month' : 'Months';
                $m = date('m', strtotime('-'.$i.' '.$d, strtotime($today)));
                $y = date('Y', strtotime('-'.$i.' '.$d, strtotime($today)));
                $labels[] = date('Y-m', strtotime('-'.$i.' '.$d, strtotime($today)));
                $data[] = OrderData::
                whereHas('order', function($q) {
                    $q->where('orderstatus', 'Success');
                })
                ->where('product_id', $product_id)->whereYear('created_at', $y)->whereMonth('created_at', $m)->sum('rate_total');
            }
            break;

            case "Year":
            $labels = [];
            $data = [];
            $duration = $duration == 0 ? 5 : $duration;
            $s = (($duration * $page)-$duration);
            $l = $duration * $page;
            for($i=$s;$i<$l;$i++){
                $d = $i == 0 ? 'Year' : 'Years';
                $labels[] = $y = date('Y', strtotime('-'.$i.' '.$d, strtotime($today)));
                $data[] = OrderData::
                whereHas('order', function($q) {
                    $q->where('orderstatus', 'Success');
                })
                ->where('product_id', $product_id)->whereYear('created_at', $y)->sum('rate_total');
            }
            break;

        }

        $color = "#". substr(md5(rand()), 0, 6);
        $this->labels($labels);
        $this->loaderColor('#000000');
        $this->options(["responsive"=>true]);
        $this->dataset('Sale', $typ, $data)->color($color)->backgroundColor($color.'20')->fill(true);

    }
}
