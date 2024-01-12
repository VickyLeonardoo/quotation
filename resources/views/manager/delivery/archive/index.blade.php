@extends('partials.manager.header')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        @foreach ($years as $year)
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <a href="{{ url('admin/delivery/archive/' . $year->year) }}">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-archive text-dark"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">{{ $year->year }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        {{ $years->links() }}
    </div>
@endsection
