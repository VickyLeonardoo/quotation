@extends('partials.karyawan.header')

@section('title', Route::is('karyawan.project.ongoing') ? 'Project Ongoing':'Project Done')

@section('title', 'Project Ongoing')

@section('content')
    <div class="row">
        <div class="container">
            <div class="page-inner page-inner-tab-style">
                <div class="page-header">
                    <h3>Daftar Project</h3>
                </div>
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Quotation</th>
                                <th>Nama</th>
                                <th>Customer</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $project->quotation->quotationNo }}</td>
                                    <td>{{ $project->nama }}</td>
                                    <td>{{ $project->quotation->perusahaan->nama }}</td>
                                    <td>{{ Carbon\Carbon::parse($project->tglMulai)->isoFormat('DD MMMM YYYY') }}</td>
                                    <td>{{ $project->tglSelesai == '' ? Carbon\Carbon::parse($project->tglSelesai)->isoFormat('DD MMMM YYYY'):'-'}}</td>
                                    <td>
                                        <a href="{{ route('karyawan.project.ongoing.update',$project->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
