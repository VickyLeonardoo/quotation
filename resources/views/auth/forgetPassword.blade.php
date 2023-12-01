
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login | Password Recovery</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('atlantis') }}/assets/img/icon.ico" type="image/x-icon"/>
	<!-- Fonts and icons -->
	<script src="{{ asset('atlantis') }}/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('atlantis') }}/assets/css/fonts.min.css']},
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
			<h3 class="text-center">Recovery Password</h3>
			<div class="login-form">
				<div class="form-group form-floating-label">
					<input id="username" name="username" type="text" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Email</label>
				</div>

				<div class="form-action mb-3">
					<a href="#" class="btn btn-primary btn-rounded btn-login">Pulihkan</a>
				</div>
					<a href="{{ url('/login') }}" class="link float-right">Sign in</a>
			</div>
		</div>
	</div>
</body>
</html>
