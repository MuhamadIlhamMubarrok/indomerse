<?php

namespace App\Charts;

use App\Models\Product;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProductChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
 $tahun = date("Y");
    $bulan = date("m");

    $soldOutProducts = [];

    for ($i = 1; $i <= $bulan; $i++) {
        $soldOutProducts[] = Product::where('status', 'sold out')  // Memilih produk dengan status 'sold out'
            ->whereYear("created_at", $tahun)
            ->whereMonth("created_at", $i)
            ->count(); // Menghitung jumlah produk yang 'sold out'
    }

    return $this->chart->lineChart()
        ->setTitle('Sold Out Products during ' . $tahun . '.')
        ->setSubtitle('Number of sold out products per month.')
        ->addData('Sold Out Products', $soldOutProducts)
        ->setWidth(1000)
        ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'july', 'agustust', 'september', 'oktober', 'november', 'desember']);
    }
}
