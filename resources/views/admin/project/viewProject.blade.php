@extends('partials.admin.header')

@section('title', Route::is('admin.project.ongoing') ? 'Project Ongoing':'Project Done')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        {{-- <a href="{{ url('admin/invoice-draft/create') }}" class="btn btn-info">Tambah</a> --}}
                        <div class="card-category"></div>
                        <h4 class="page-title">Daftar Project</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Quotation No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $project->quotation->quotationNo }}</td>
                                    <td>{{ $project->nama }}</td>
                                    <td>{{ Carbon\Carbon::parse($project->tglMulai)->isoFormat('DD MMMM YYYY') }}</td>
                                    <td>{{ Carbon\Carbon::parse($project->tglSelesai)->isoFormat('DD MMMM YYYY') }}</td>
                                    <td>
                                        @if ($project->status == 0)
                                            <div class="badge bg-info">Dalam Pengerjaan</div>
                                        @else
                                            <div class="badge bg-success">Selesai Pengerjaan</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($project->status == 0)
                                        <a href="{{ route('admin.project.ongoing.edit',$project->id) }}" title="Quotation" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger" title="Hapus" id="alert_demo_8"><i class="fas fa-trash"></i></button>
                                        @else
                                        <a href="{{ route('admin.project.done.edit',$project->id) }}" title="Quotation" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger" title="Hapus" id="alert_demo_8"><i class="fas fa-trash"></i></button>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
