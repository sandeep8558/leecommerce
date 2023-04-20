<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\SubCategory;
use App\Models\OrderData;

class SubCategorySale extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($what='Day', $typ='line', $duration=0, $page=1, $category_id=1)
    {
        parent::__construct();

        $today = date("Y-m-d");
        $sub_categories = SubCategory::where('category_id', $category_id)->get();

        switch($what){
            
            case "Day":
            $duration = $duration == 0 ? 7 : $duration;
            $s = (($duration * $page)-$duration);
            $l = $duration * $page;
            $labels = [];
            for($i=$s;$i<$l;$i++){
                $d = $i == 0 ? 'Day' : 'Days';
                $labels[] = $dt = date('Y-m-d', strtotime('-'.$i.' '.$d, strtotime($today)));                
            }

            $color = [];
            $category = [];
            $value = [];

            foreach($sub_categories as $cat){
                $color[] = "#". substr(md5(rand()), 0, 6);
                $category[] = $cat->sub_category;
                $data = [];
                $s = (($duration * $page)-$duration);
                $l = $duration * $page;
                for($i=$s;$i<$l;$i++){
                    $dt = date('Y-m-d', strtotime('-'.$i.' '.$d, strtotime($today)));
                    $data[] = OrderData::
                    whereHas('order', function($q) {
                        $q->where('orderstatus', 'Success');
                    })
                    ->whereHas('product', function($q) use($cat){
                        $q->whereHas('sub_category', function($qq) use($cat){
                            $qq->where('id',  $cat->id);
                        });
                    })
                    ->whereDate('created_at', $dt)
                    ->sum('rate_total');
                }
                $value[] = $data;
            }
            break;

            case "Month":
            $duration = $duration == 0 ? 6 : $duration;
            $s = (($duration * $page)-$duration);
            $l = $duration * $page;
            $labels = [];
            for($i=$s;$i<$l;$i++){
                $d = $i == 0 ? 'Month' : 'Months';
                $m = date('m', strtotime('-'.$i.' '.$d, strtotime($today)));
                $y = date('Y', strtotime('-'.$i.' '.$d, strtotime($today)));
                $labels[] = date('Y-m', strtotime('-'.$i.' '.$d, strtotime($today)));             
            }

            $color = [];
            $category = [];
            $value = [];

            foreach($sub_categories as $cat){
                $color[] = "#". substr(md5(rand()), 0, 6);
                $category[] = $cat->sub_category;
                $data = [];
                $s = (($duration * $page)-$duration);
                $l = $duration * $page;
                for($i=$s;$i<$l;$i++){
                    $d = $i == 0 ? 'Month' : 'Months';
                    $m = date('m', strtotime('-'.$i.' '.$d, strtotime($today)));
                    $y = date('Y', strtotime('-'.$i.' '.$d, strtotime($today)));
                    $data[] = OrderData::
                    whereHas('order', function($q) {
                        $q->where('orderstatus', 'Success');
                    })
                    ->whereHas('product', function($q) use($cat){
                        $q->whereHas('sub_category', function($qq) use($cat){
                            $qq->where('id',  $cat->id);
                        });
                    })
                    ->whereYear('created_at', $y)
                    ->whereMonth('created_at', $m)
                    ->sum('rate_total');
                }
                $value[] = $data;
            }
            break;

            case "Year":
            $duration = $duration == 0 ? 6 : $duration;
            $s = (($duration * $page)-$duration);
            $l = $duration * $page;
            $labels = [];
            for($i=$s;$i<$l;$i++){
                $d = $i == 0 ? 'Year' : 'Years';
                $labels[] = $y = date('Y', strtotime('-'.$i.' '.$d, strtotime($today)));            
            }

            $color = [];
            $category = [];
            $value = [];

            foreach($sub_categories as $cat){
                $color[] = "#". substr(md5(rand()), 0, 6);
                $category[] = $cat->sub_category;
                $data = [];
                $s = (($duration * $page)-$duration);
                $l = $duration * $page;
                for($i=$s;$i<$l;$i++){
                    $d = $i == 0 ? 'Year' : 'Years';
                    $y = date('Y', strtotime('-'.$i.' '.$d, strtotime($today)));
                    $data[] = OrderData::
                    whereHas('order', function($q) {
                        $q->where('orderstatus', 'Success');
                    })
                    ->whereHas('product', function($q) use($cat){
                        $q->whereHas('sub_category', function($qq) use($cat){
                            $qq->where('id',  $cat->id);
                        });
                    })
                    ->whereYear('created_at', $y)
                    ->sum('rate_total');
                }
                $value[] = $data;
            }
            break;

        }



        $this->labels($labels);
        $this->loaderColor('#000000');
        $this->options(["responsive"=>true]);

        foreach($value as $key=>$val){
            $this->dataset($category[$key], $typ, $val)->color($color[$key])->backgroundColor($color[$key].'20')->fill(true);
        }

        if(sizeof($value) <= 0){
            $this->dataset("Sub Category Not Found", $typ, [])->color('#ff0000')->backgroundColor('#ff000020')->fill(true);
        }
    }
}
