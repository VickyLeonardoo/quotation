@extends('partials.manager.header')

@section('title', 'Tambah Invoice')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="text-right">
                            <a href="{{ url('manager/invoice-draft') }}" class="btn btn-info"><i class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                        <div class="card-category"></div>
                    </div>
                    <form action="{{ route('manager.delivery.draft.update',$delivery->id) }}" method="POST">
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
                            <label for="">Invoice No</label>
                            <input type="text" class="form-control" value="{{ $delivery->invoice->quotation->quotationNo }}|{{ $delivery->invoice->quotation->perusahaan->nama }}|{{ $delivery->invoice->invoiceNo }}" readonly>
                                {{-- @foreach ($invoices as $inv)
                                    <option value="{{ $inv->id }}">{{ $inv->quotation->quotationNo }} |
                                        {{ $inv->quotation->perusahaan->nama }} | {{ $inv->invoiceNo }}</option>
                                @endforeach --}}
                            </select>
                            @error('invoice_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Delivery No</label>
                            <input type="text" readonly class="form-control" name="deliveryNo" value="{{ $delivery->deliveryNo }}">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="text" class="form-control {{ $errors->has('tglDelivery') ? 'is-invalid':'' }}" name="tglDelivery" placeholder="Masukkan Tanggal" onfocus="(this.type='date')"onblur="(this.type='text')" value="{{ $delivery->tglDelivery }}">
                            @error('tglDelivery')
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
