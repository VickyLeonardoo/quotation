<?php

namespace App\Http\Controllers;

use App\Charts\KaryawanProjectChart;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(KaryawanProjectChart $karyawanProjectChart){
        if (auth()->user()->role == 1){
            return view('admin.index');
        }else if (auth()->user()->role == 2) {
            return view('karyawan.index',[
                'projectGoingCount' => Project::where('status','0')->count(),
                'projectDoneCount' => Project::where('status','1')->count(),
                'karyawanProjectChart' => $karyawanProjectChart->build(),
            ]);
        }else{
            return view('manager.index');
        }
    }
}
