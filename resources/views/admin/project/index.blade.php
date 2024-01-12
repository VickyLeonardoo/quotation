@extends('partials.admin.header')
@section('title','Invoice')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <a href="{{ url('admin/project-ongoing') }}">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-chart-pie text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Ongoing</p>
                                <h4 class="card-title">{{ $ongoCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <a href="{{ url('admin/project-done') }}">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-coins text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Done</p>
                                <h4 class="card-title">{{ $doneCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <a href="{{ url('admin/project/archive') }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-error text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Arsip</p>
                                <h4 class="card-title">{{ $archiveCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
