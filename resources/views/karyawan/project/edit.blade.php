@extends('partials.karyawan.header')

@section('title', Route::is('karyawan.project.ongoing*') ? 'Edit Project' : 'Project Done')

@section('title', 'Project Ongoing')

@section('content')
    <div class="mb-3">
        <a href="{{ url('karyawan/project/ongoing') }}" class="btn btn-primary">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container">
                    <form action="">
                        <div class="row">
                            <div class="col-6 col-sm-4 col-lg-6">
                                <div class="form-group">
                                    <label for="">Nama Project</label>
                                    <input type="text" name="nama" class="form-control" readonly
                                        value="{{ $project->nama }}">
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-lg-6">
                                <div class="form-group">
                                    <label for="">Nomor Quotation</label>
                                    <input type="text" name="nama" class="form-control" readonly
                                        value="{{ $project->quotation->quotationNo }}">
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-lg-6">
                                <div class="form-group">
                                    <label for="">Tanggal Mulai</label>
                                    <input type="text" name="nama" class="form-control" readonly
                                        value="{{ $project->tglMulai }}">
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-lg-6">
                                <div class="form-group">
                                    <label for="">Tanggal Selesai</label>
                                    <input type="text" name="nama" class="form-control" readonly
                                        value="{{ $project->tglSelesai }}">
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-lg-12">
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" readonly rows="3">{{ $project->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 col-lg-12">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <input type="text"
                                        value="{{ $project->status == 0 ? 'Dalam Pengerjaan' : 'Selesai' }}" readonly
                                        class="form-control" name="" id="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4>Log Pengerjaan</h4>
                </div>
                <div class="col-6">
                    @if ($project->status == 0)
                    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        Tambah
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Deskripsi Pekerjaan</th>
                            <th>Kemajuan</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project->logbook as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->tglPekerjaan)->isoFormat('D MMMM Y') }}</td>
                                <td>{{ $log->deskripsi }}</td>
                                <td>{{ $log->persentase }}%</td>
                                <td style="width: 5%">
                                    @if ($project->status == 0)
                                    <a href="{{ route('karyawan.project.ongoing.delete.lobgook',$log->id) }}" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('karyawan.project.ongoing.store.lobgook', $project->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-2">
                                <b>
                                    Kemajuan Proyek:
                                </b>
                            </div>


                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"
                                        class="form-control {{ $errors->has('persentase') ? 'is-invalid' : '' }}"
                                        name="persentase" value="{{ old('persentase') }}" placeholder="Masukkan persentase contoh: 30">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    @error('persentase')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <b>
                                    Deskripsi Pekerjaan:
                                </b>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <textarea name="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}" rows="4"
                                        placeholder="Isi deskripsi pekerjaan minimal 10 karakter">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <b>
                                    Tanggal Pekerjaan:
                                </b>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input type="date"
                                        class="form-control {{ $errors->has('tglPekerjaan') ? 'is-invalid' : '' }}"
                                        name="tglPekerjaan" value="{{ old('tglPekerjaan') }}">
                                    @error('tglPekerjaan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
