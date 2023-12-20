<?php

namespace App\Http\Controllers;

use App\Charts\KaryawanProjectChart;
use App\Charts\MonthlyQuotationChart;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Invoice;
use App\Models\Quotation;

class DashboardController extends Controller
{
    public function index(KaryawanProjectChart $karyawanProjectChart, MonthlyQuotationChart $monthlyQuotationChart){
        $totalPendapatan = 0;

        $projects = Project::where('is_archive', '0')->where('status', '0')->orderBy('created_at', 'desc')->get();
        $qtoCount = Quotation::where('is_archive','0')->whereIn('status',['0','1','2','3','4'])->count();
        $invCount = Invoice::where('is_archive','0')->whereIn('status',['0','1','2','3','4'])->count();
        $doCount = Delivery::where('is_archive','0')->count();
        $proCount = Project::where('is_archive','0')->count();
        $qtoAppCount = Quotation::where('is_archive','0')->where('status','1')->count();
        $invAppCount = Invoice::where('is_archive','0')->where('status','1')->count();
        if (auth()->user()->role == 1){
            return view('admin.index',[
                'MonthlyQuotationChart' => $monthlyQuotationChart->build(),
                'adminProjectChart' => $karyawanProjectChart->build(),
                'projects' => $projects,
                'qtoCount' => $qtoCount,
                'invCount' => $invCount,
                'doCount' => $doCount,
                'proCount' => $proCount,
                'totalPendapatan' => $totalPendapatan,
            ]);
        }else if (auth()->user()->role == 2) {
            return view('karyawan.index',[
                'projectGoingCount' => Project::where('status','0')->count(),
                'projectDoneCount' => Project::where('status','1')->count(),
                'karyawanProjectChart' => $karyawanProjectChart->build(),
            ]);
        }else{
            return view('manager.index',[
                'MonthlyQuotationChart' => $monthlyQuotationChart->build(),
                'adminProjectChart' => $karyawanProjectChart->build(),
                'projects' => $projects,
                'qtoCount' => $qtoCount,
                'invCount' => $invCount,
                'doCount' => $doCount,
                'proCount' => $proCount,
                'totalPendapatan' => $totalPendapatan,
                'invAppCount' => $invAppCount,
                'qtoAppCount' => $qtoAppCount,
            ]);
        }
    }
}
