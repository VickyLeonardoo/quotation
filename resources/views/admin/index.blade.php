@extends('partials.admin.header')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-chart-pie text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Quotation</p>
                                <h4 class="card-title">{{ $qtoCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-coins text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Invoice</p>
                                <h4 class="card-title">{{ $invCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-error text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Project</p>
                                <h4 class="card-title">{{ $proCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-twitter text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Delivery Order</p>
                                <h4 class="card-title">{{ $doCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">User Statistics</div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        {!! $MonthlyQuotationChart->container() !!}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Estimasi Pendapatan
                </div>
                <div class="card-body">
                    @currency($totalPendapatan)
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-1 fw-bold">Tasks Progress</h4>
                    <div id="task-complete" class="chart-circle mt-4 mb-3"></div>
                    {!! $adminProjectChart->container() !!}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Project Berjalan</div>
                    {{-- <div class="card-category">March 25 - April 02</div> --}}
                </div>
                <div class="card-body pb-0">
                    <div class="mb-4 mt-2">
                    </div>
                    <div class="pull-in">
                        <div class="table-responsive">
                            <table id="" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Quotation No</th>
                                        {{-- <th>Progres</th> --}}
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $project->quotation->quotationNo }}</td>
                                        {{-- <td>{{ $project->logbook->last()->persentase}}%</td> --}}
                                        <td><a href="{{ url('admin/project-ongoing/'.$project->id.'/edit') }}">Periksa</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="4"><a href="{{ url('admin/project-ongoing') }}">Periksa Seluruhnya</a></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ $MonthlyQuotationChart->cdn() }}"></script>

    {{ $MonthlyQuotationChart->script() }}

    <script src="{{ $adminProjectChart->cdn() }}"></script>

    {{ $adminProjectChart->script() }}
@endsection
