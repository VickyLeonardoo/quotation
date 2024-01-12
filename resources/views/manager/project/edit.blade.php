@extends('partials.manager.header')

@section('title', 'Edit Project')

@section('content')
    <div class="row">
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert bg-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="text-right">
                @if ($project->is_archive == 1)
                <button onclick="history.back()" class="btn btn-info">Kembali</button>
                @else
                <a href="{{ url('manager/project-ongoing') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
                @endif

            </div>
            <div class="card-category"></div>
        </div>
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-header">
                    <h5>Detail Project</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('manager.project.ongoing.update', $project->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nama Project:</label>
                                    <input type="text" name="nama" {{ $project->status == 1 ? 'readonly':'' }}  class="form-control" value="{{ $project->nama }}"
                                        placeholder="Masukkan Nama Project">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nomor Quotation:</label>
                                    <input type="text" name="quotation_id" class="form-control"
                                        value="{{ $project->quotation->quotationNo }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tanggal Selesai</label>
                                    <input type="text"  class="form-control" value="{{ $project->tglMulai }}" name="tglMulai" {{ $project->status == 1 ? 'readonly':'' }}
                                        placeholder="Masukkan Tanggal Selesai"
                                        onfocus="(this.type='date')"onblur="(this.type='text')">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tanggal Selesai</label>
                                    <input type="text"  class="form-control" value="{{ $project->tglSelesai }}" name="tglSelesai" {{ $project->status == 1 ? 'readonly':'' }}
                                        placeholder="Masukkan Tanggal Selesai"
                                        onfocus="(this.type='date')"onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Project:</label>
                            <textarea name="deskripsi" {{ $project->status == 1 ? 'readonly':'' }}  class="form-control" placeholder="Masukkan Deskripsi Project" rows="3">{{ $project->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Status:</label>
                            <select name="status" {{ $project->status == 1 ? 'readonly':'' }}  class="form-control">
                                <option value="0" {{ $project->status == '0' ? 'selected' : '' }}>Dalam Pengerjaan
                                </option>
                                <option value="1" {{ $project->status == '1' ? 'selected' : '' }}>Selesai Pengerjaan
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update" readonly class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4>Log Pengerjaan</h4>
                        </div>
                        {{-- <div class="col-6">
                            <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">Tambah</button>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Deskripsi Pekerjaan</th>
                                    <th>Kemajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($project->logbook as $log)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($log->tglPekerjaan)->isoFormat('D MMMM Y') }}</td>
                                        <td>{{ $log->deskripsi }}</td>
                                        <td>{{ $log->persentase }}%</td>
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
