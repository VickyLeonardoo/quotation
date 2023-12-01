<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('atlantis') }}/assets/img/icon.ico" type="image/x-icon" />
    <!-- Fonts and icons -->
    <script src="{{ asset('atlantis') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('atlantis') }}/assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('atlantis') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('atlantis') }}/assets/css/atlantis.css">
</head>

<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <h3 class="text-center">Sign In To Admin</h3>
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <div class="login-form">
                <form action="{{ url('proses-login') }}" method="POST">
                    @csrf
                    <div class="form-group form-floating-label">
                        <input name="email" type="text" class="form-control input-border-bottom {{ $errors->has('email') ? 'is-invalid':''}}">
                        <label for="username" class="placeholder">Email</label>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="password" name="password" type="password" class="form-control input-border-bottom {{ $errors->has('password') ? 'is-invalid':'' }}">
                        <label for="password" class="placeholder">Password</label>
                        <div class="show-password" id="toggle-password">
                            <i class="icon-eye"></i>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row form-sub m-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberme">
                        </div>

                        <a href="{{ url('/forget-password') }}" class="link float-right">Lupa Password ?</a>
                    </div>
                    <div class="form-action mb-3">
                        <button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Sweet Alert -->
<script src="{{ asset('atlantis') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    @if (session('logout'))
        <script>
            swal("Logout!", "Kamu berhasil Logout!", {
                icon : "success",
                buttons: {
                    confirm: {
                        className : 'btn btn-success'
                    }
                },
            });
        </script>
    @endif
    <script>
        $(document).ready(function () {
            $("#toggle-password").click(function () {
                var passwordField = $("#password");
                var passwordFieldType = passwordField.attr('type');

                // Toggle password visibility
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                } else {
                    passwordField.attr('type', 'password');
                }
            });
        });
    </script>
</body>

</html>
