<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SampleChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->labels(['One', 'Two', 'Three', 'Four']);
        $this->dataset('Purchase', 'line', [1,2,3,4])->color('red')->fill(true);
        $this->loaderColor('#000000');
        $this->height(400);
        
    }

}
