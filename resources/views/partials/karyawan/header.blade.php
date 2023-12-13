
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>SIQ | @yield('title')</title>
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
	<link rel="stylesheet" href="{{ asset('atlantis') }}/assets/css/atlantis2.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

</head>
<body data-background-color="custom"  style="background: #9398a7">
	<div class="wrapper horizontal-layout-3 fullwidth-style">

		<div class="main-header no-box-shadow" data-background-color="transparent">
			<div class="nav-top">
				<div class="container d-flex flex-row">
					<button class="navbar-toggler sidenav-toggler2 ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon">
							<i class="icon-menu"></i>
						</span>
					</button>
					<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
					<!-- Logo Header -->
					<a href="index.html" class="logo logo-fixed d-flex align-items-center">
						<img src="{{ asset('atlantis') }}/assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
						<img src="{{ asset('atlantis') }}/assets/img/logo2.svg" alt="navbar brand" class="navbar-brand navbar-brand-logo-fixed">
					</a>
					<!-- End Logo Header -->

					<!-- Navbar Header -->
					<nav class="navbar navbar-header navbar-expand-lg p-0">
						<div class="container-fluid p-0">
							<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
								<li class="nav-item dropdown hidden-caret">
									<ul class="dropdown-menu dropdown-search animated fadeIn">
										<form class="navbar-left navbar-form nav-search">
											<div class="input-group">
												<input type="text" placeholder="Search ..." class="form-control">
											</div>
										</form>
									</ul>
								</li>
								<li class="nav-item dropdown hidden-caret">
									<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
										<div class="avatar-sm">
											<img src="{{ asset('atlantis') }}/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
										</div>
									</a>
									<ul class="dropdown-menu dropdown-user animated fadeIn">
										<div class="dropdown-user-scroll scrollbar-outer">
											<li>
												<div class="user-box">
													<div class="avatar-lg"><img src="{{ asset('atlantis') }}/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
													<div class="u-text">
														<h4>{{ auth()->user()->name }}</h4>
														<p class="text-muted">{{ auth()->user()->email }}</p><a href="{{ url('karyawan/profile') }}" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
													</div>
												</div>
											</li>
											<li>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
											</li>
										</div>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
					<!-- End Navbar -->
				</div>
			</div>
		</div>
		<div class="pt-lg-2">
			<div class="container text-white pt-lg-2">
				<nav class="navbar navbar-tab navbar-header-left navbar-expand-lg p-0">
					<ul class="navbar-nav page-navigation">
						<h3 class="title-menu bg-primary d-flex d-lg-none">
							Menu
							<div class="close-menu"> <i class="flaticon-cross"></i></div>
						</h3>
						<li class="nav-item {{ Route::is('karyawan.dashboard') ? 'active':''}}">
							<a class="nav-link" href="{{ url('karyawan') }}">
								Dashboard
							</a>
						</li>
						{{-- <li class="nav-item {{ Route::is('karyawan.quotation*') ? 'active':''}}">
							<a class="nav-link" href="{{ url('karyawan/quotation') }}">
								Quotation
							</a>

						</li> --}}
						<li class="nav-item dropdown {{ Route::is('karyawan.project*') ? 'active':'' }}">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Projects
							</a>
							<div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
								<a class="dropdown-item {{ Route::is('karyawan.project.ongoing*') ? 'active':'' }}" href="{{ url('karyawan/project/ongoing') }}">On Going Project</a>
								<a class="dropdown-item {{ Route::is('karyawan.project.done*') ? 'active':'' }}" href="{{ url('karyawan/project/done') }}">Done Project</a>
							</div>
						</li>
					</ul>
				</nav>
			</div>
		</div>

		<div class="main-panel">
			<div class="container">
				<div class="page-inner page-inner-tab-style">
					<div class="page-header justify-content-end">
						{{-- <h4 class="page-title">Dashboard</h4> --}}
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Karyawan</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">@yield('title')</a>
							</li>
						</ul>
					</div>
                    @yield('content')
				</div>
			</div>
		</div>
		<footer class="footer border-0 bg-transparent">
			<div class="container-fluid">
				<nav class="pull-left">
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link text-white" href="http://www.themekita.com">
								ThemeKita
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white" href="#">
								Help
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-white" href="#">
								Licenses
							</a>
						</li>
					</ul>
				</nav>
				<div class="copyright text-white ml-auto">
					2018, made with <i class="fa fa-heart heart text-danger"></i> by <a class=" text-white" href="http://www.themekita.com">ThemeKita</a>
				</div>
			</div>
		</footer>
	</div>
	<!--   Core JS Files   -->
	@include('partials.karyawan.script')
</body>
</html>
