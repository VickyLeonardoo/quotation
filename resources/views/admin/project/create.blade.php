@extends('partials.admin.header')

@section('title', 'Edit Project')

@section('content')
    <div class="row">
        <div class="container-fluid">
            @if (session('success'))
            <div class="alert bg-success" role="alert">
                {{ session('success') }}
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="pull-right bg-danger" style="border: none;" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                Project telah tersedia, <a href="{{ route('admin.project.ongoing.edit',session('error')) }}">periksa project disini</a>
            </div>
            @endif
            <div class="text-right">
                <a href="{{ url('admin/project-ongoing') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>
            <div class="card-category"></div>
        </div>
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-header">
                    <h5>Tambah Project</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.project.ongoing.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nomor Quotation:</label>
                                    <select name="quotation_id" class="form-control selectpicker" data-live-search="true">
                                        @foreach ($quotations as $qto)
                                            <option value="{{ $qto->id }}">{{ $qto->quotationNo }} |
                                                {{ $qto->perusahaan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('quotation_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Tambah" readonly class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
