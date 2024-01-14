@extends('partials.manager.header')
@section('title', 'Profile')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-with-nav">
                <div class="card-body">
                    <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                        <li class="nav-item submenu">
                            <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Password</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <form action="{{ url('manager/profile') }}" method="POST">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Name</label>
                                            <input type="text" autocomplete="off" class="form-control" name="name" placeholder="Name"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Email</label>
                                            <input type="text" autocomplete="off" class="form-control" readonly name="email"
                                                placeholder="Name" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Birth Date</label>
                                            @if ($user->user_detail)
                                            <input type="date" class="form-control" id="datepicker" name="tglLahir" value="{{ $user->user_detail->tglLahir }}" placeholder="Birth Date">
                                            @else
                                            <input type="date" class="form-control" id="datepicker" name="tglLahir" value="" placeholder="Birth Date">
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Gender</label>
                                            @if ($user->user_detail)
                                            <select class="form-control" id="gender" name="jk">
                                                <option {{ $user->user_detail->jk == 'L' ? 'selected' : '' }}
                                                    value="L">Male</option>
                                                <option {{ $user->user_detail->jk == 'P' ? 'selected' : '' }}
                                                    value="P">Female</option>
                                            </select>
                                            @else
                                            <select class="form-control" id="gender" name="jk">
                                                <option value="L">Male</option>
                                                <option value="P">Female</option>
                                            </select>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Phone</label>
                                            @if ($user->user_detail)
                                            <input type="text" autocomplete="off" class="form-control" value="{{ $user->user_detail->noHp }}" name="noHp" placeholder="Phone">
                                            @else
                                            <input type="text" autocomplete="off" class="form-control" value="" name="noHp" placeholder="Phone">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Address</label>
                                            @if ($user->user_detail)
                                            <input type="text"  autocomplete="off" class="form-control" value="{{ $user->user_detail->alamat }}" name="alamat" placeholder="Address">
                                            @else
                                            <input type="text"  autocomplete="off" class="form-control" value="" name="alamat" placeholder="Address">

                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3 mb-3">
                                    <input type="submit" class="btn btn-success" value="Simpan">
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <form action="{{ url('manager/profile/password') }}" method="POST">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Password Baru</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Masukkan Password Baru" value="">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group form-group-default">
                                            <label>Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="Konfirmasi Password Baru" value="">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3 mb-3">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                $('#pills-profile-tab').tab('show');
            @endif
        });
    </script>
@endsection
