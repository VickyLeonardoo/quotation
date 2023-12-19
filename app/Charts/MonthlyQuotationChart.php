<?php

namespace App\Charts;

use App\Models\Quotation;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyQuotationChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        // Mendapatkan tahun dan bulan aktif sekarang
        // Mendapatkan tahun dan bulan aktif sekarang
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Mengambil data jumlah quotation per bulan dengan status 3 atau 4 untuk tahun sekarang
        $currentYearData = Quotation::selectRaw('MONTH(tglQuotation) as month, COUNT(*) as count')
            ->whereYear('tglQuotation', '=', $currentYear)
            ->where('status', '>=', 3) // Hanya status 3 dan 4
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Mengambil data jumlah quotation per bulan dengan status 3 atau 4 untuk tahun sebelumnya
        $previousYearData = Quotation::selectRaw('MONTH(tglQuotation) as month, COUNT(*) as count')
            ->whereYear('tglQuotation', '=', $currentYear - 1)
            ->where('status', '>=', 3) // Hanya status 3 dan 4
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Inisialisasi data untuk chart
        $chartDataCurrentYear = [];
        $chartDataPreviousYear = [];
        $xAxisLabels = [];

        // Loop untuk mengisi data chart dan label bulan
        for ($i = 1; $i <= $currentMonth; $i++) {
            $xAxisLabels[] = date('F', mktime(0, 0, 0, $i, 1));
            $currentYearCount = $currentYearData->where('month', $i)->first()->count ?? 0;
            $previousYearCount = $previousYearData->where('month', $i)->first()->count ?? 0;

            // Menambahkan data untuk tahun sekarang dan tahun sebelumnya
            $chartDataCurrentYear[] = $currentYearCount;
            $chartDataPreviousYear[] = $previousYearCount;
        }

        // Membuat chart LarapexCharts
        $chart = $this->chart
            ->areaChart()
            ->setTitle("Sales Comparison between $currentYear and " . ($currentYear - 1))
            ->setSubtitle('Sales ' . $currentYear . ' vs Sales ' . ($currentYear - 1))
            ->addData('Quotation Count - ' . $currentYear, $chartDataCurrentYear)
            ->addData('Quotation Count - ' . ($currentYear - 1), $chartDataPreviousYear)
            ->setXAxis($xAxisLabels);

        return $chart;
    }
}
