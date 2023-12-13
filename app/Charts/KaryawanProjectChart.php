<?php

namespace App\Charts;

use DateTime;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KaryawanProjectChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $going = Project::where('status', '0')->count();
        $done = Project::where('status', '1')->count();

        return $this->chart->pieChart()
            ->setTitle('Project Grafik')
            ->setSubtitle('CV. Gabril Mitra Perkasa')
            ->addData([$going, $done])
            ->setHeight(300)
            ->setLabels(['Berjalan', 'Selesai']);
    }

}
