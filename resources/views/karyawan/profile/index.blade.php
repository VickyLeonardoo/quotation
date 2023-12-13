@extends('partials.karyawan.header')

@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="container">
            @error('password')
            <div class="alert bg-danger alert-dismissible">
                <h5 style="color: white">{{ $message }}</h5>
            </div>
            @enderror
            <div class="text-right">
                <a href="#" id="editBtn" class="btn btn-sm btn-primary">Edit</a>
                <button id="cancelBtn" class="btn btn-sm btn-secondary" style="display: none;">Batal</button>
                <a href="#" id="passBtn" class="btn btn-sm btn-info">Ganti Password</a>
            </div>
            <div class="page-inner page-inner-tab-style">
                <form action="{{ route('karyawan.update.profile') }}" method="POST" id="formProfile">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" name="name" id="namaInput" value="{{ auth()->user()->name }}" readonly>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
                <form action="{{ route('karyawan.update.password') }}" id="formPassword" style="display: none;" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Password Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('#editBtn').click(function(){
            $('#namaInput').prop('readonly', false);
            $('#formProfile').show();
            $('#passBtn').hide();
            $('#editBtn').hide();
            $('#cancelBtn').show();
        });

        $('#cancelBtn').click(function(){
            $('#namaInput').prop('readonly', true);
            $('#formProfile').show();
            $('#passBtn').show();
            $('#editBtn').show();
            $('#cancelBtn').hide();
        });

        $('#passBtn').click(function(){
            $('#formProfile').hide();
            $('#editBtn').hide();
            $('#cancelBtn').show();
            $('#passBtn').hide();
            $('#formPassword').show();
        });
    });
</script>
@endsection
