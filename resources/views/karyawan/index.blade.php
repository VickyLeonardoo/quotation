@extends('partials.karyawan.header')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-12 col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body p-3 text-center">
                <div class="text-right text-success">
                    {{-- 6% --}}
                    {{-- <i class="fa fa-chevron-up"></i> --}}
                </div>
                <div class="h1 m-0">{{ $projectGoingCount }}</div>
                <div class="text-muted mb-3">Project Ongoing</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body p-3 text-center">
                <div class="text-right text-danger">
                    {{-- -3% --}}
                    {{-- <i class="fa fa-chevron-down"></i> --}}
                </div>
                <div class="h1 m-0">{{ $projectDoneCount }}</div>
                <div class="text-muted mb-3">Project Selesai</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Project Statistik</div>
                    <div class="card-tools">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container" style="min-height: 375px">
                    {!! $karyawanProjectChart->container() !!}
                    <canvas id="statisticsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ $karyawanProjectChart->cdn() }}"></script>

{{ $karyawanProjectChart->script() }}
@endsection
