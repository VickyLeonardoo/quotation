@extends('partials.admin.header')

@section('title', 'Edit Invoice')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="text-right">
                            <a href="{{ url('admin/invoice-draft') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                        <div class="card-category"></div>
                    </div>
                    <form action="{{ route('admin.invoice.draft.update',$inv->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            @if (session('error'))
                            <div class="alert alert-warning bg-danger alert-dismissible fade show text-white" role="alert">
                                <button type="button" class="pull-right bg-danger" style="border: none;" data-dismiss="alert" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                                {{ session('error') }}
                            </div>
                            @endif
                            <label for="">Quotation No</label>
                            <select name="quotation_id" class="form-control selectpicker" data-live-search="true">
                                @foreach ($quotations as $qto)
                                    <option value="{{ $qto->id }}" {{ $qto->id == $inv->quotation->id ? 'selected':'' }}>{{ $qto->quotationNo }} |
                                        {{ $qto->perusahaan->nama }}</option>
                                @endforeach
                            </select>
                            @error('quotation_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Invoice No</label>
                            <input type="text" readonly class="form-control" name="invoiceNo"
                                value="{{ $inv->invoiceNo }}">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="text" class="form-control {{ $errors->has('tglInvoice') ? 'is-invalid':'' }}" name="tglInvoice" placeholder="Masukkan Tanggal" onfocus="(this.type='date')"onblur="(this.type='text')" value="{{ $inv->tglInvoice }}">
                            @error('tglInvoice')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Batas Pembayaran</label>
                            <select name="payment_due" class="form-control">
                                <option value="15" {{ $inv->payment == 15 ? 'selected':'' }}>15 Hari</option>
                                <option value="30" {{ $inv->payment == 30 ? 'selected':'' }}>30 Hari</option>
                                <option value="45" {{ $inv->payment == 45 ? 'selected':'' }}>45 Hari</option>
                            </select>
                            @error('payment_due')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
