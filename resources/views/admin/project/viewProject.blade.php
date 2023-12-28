@extends('partials.admin.header')

@section('title', Route::is('admin.project.ongoing') ? 'Project Ongoing':'Project Done')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
            <div class="alert alert-warning bg-danger alert-dismissible fade show text-white" role="alert">
                <button type="button" class="pull-right bg-danger" style="border: none;" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                {{ session('error') }}
            </div>
            @endif
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <a href="{{ url('admin/project-ongoing/create') }}" class="btn btn-info">Tambah</a>
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
                                    <td>
                                        @if ($project->tglMulai)
                                        {{ Carbon\Carbon::parse($project->tglMulai)->isoFormat('DD MMMM YYYY') }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($project->tglSelesai)
                                        {{ Carbon\Carbon::parse($project->tglSelesai)->isoFormat('DD MMMM YYYY') }}
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($project->status == 0)
                                            <div class="badge bg-info">Dalam Pengerjaan</div>
                                        @else
                                            <div class="badge bg-success">Selesai Pengerjaan</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.project.ongoing.edit',$project->id) }}" title="Quotation" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger" title="Hapus" id="alertDeletePro{{ $project->id }}"><i class="fas fa-trash"></i></button>
                                        <a href="{{ route('admin.project.set.archive',$project->id) }}" title="Arsip" class="btn btn-secondary"><i class="fas fa-archive"></i></a>

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
@section('js')
    <script>
        @foreach ($projects as $project)
            $('#alertDeletePro{{ $project->id }}').click(function(e) {
                swal({
                    title: 'Hapus Project?',
                    text: "Anda akan menghapus Project?.",
                    type: 'warning',
                    buttons: {
                        cancel: {
                            visible: true,
                            text: 'Tidak, Batal!',
                            className: 'btn btn-danger'
                        },
                        confirm: {
                            text: 'Ya, Hapus!',
                            className: 'btn btn-success'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href =
                            '{{ route('admin.project.ongoing.delete', ['id' => $project->id]) }}';
                    }
                });
            });
        @endforeach
    </script>
@endsection
