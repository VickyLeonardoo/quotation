@extends('partials.manager.header')

@section('title', 'Karyawan')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="container-fluid">
                        <a href="{{ url('manager/karyawan/create') }}" class="btn btn-info">Tambah</a>
                        <div class="card-category"></div>
                        <h4 class="page-title">Daftar Karyawan</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawans as $karyawan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $karyawan->name }}</td>
                                    <td>{{ $karyawan->email }}</td>
                                    <td>{{ $karyawan->role == 1 ? 'Admin':'Teknisi' }}</td>
                                    <td>
                                        <a href="{{ route('manager.karyawan.edit',$karyawan->slug)}}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit</a>
                                        <button type="button" class="btn btn-sm btn-warning" id="alertResetPassword_{{ $karyawan->id }}"><i class="fas fa-key"></i> Reset Password</button>
                                        <button type="button" class="btn btn-sm btn-danger" id="alert_demo_8"><i class="fas fa-trash"></i> Hapus</button>
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
        @foreach ($karyawans as $karyawan)
            $('#alertResetPassword_{{ $karyawan->id }}').click(function(e) {
                swal({
                    title: 'Reset Password?',
                    text: "Password akan direset menjadi default",
                    type: 'warning',
                    buttons: {
                        cancel: {
                            visible: true,
                            text: 'Tidak, Batal!',
                            className: 'btn btn-danger'
                        },
                        confirm: {
                            text: 'Ya, Reset!',
                            className: 'btn btn-success'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = '{{ route('manager.karyawan.reset', ['id' => $karyawan->id]) }}';
                    }
                });
            });
@endforeach

    </script>
@endsection
