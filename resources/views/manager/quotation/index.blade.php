@extends('partials.manager.header')
@section('title', 'Dashboard')
@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <a href="{{ url('manager/quotation-draft') }}">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-file-invoice text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Draft</p>
                                    <h4 class="card-title">{{ $draftCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <a href="{{ url('manager/quotation-confirmed') }}">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-file-invoice text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Confirmed</p>
                                    <h4 class="card-title">{{ $confCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <a href="{{ url('manager/quotation/archive') }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-archive text-danger"></i>
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
