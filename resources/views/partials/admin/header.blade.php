
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>SIQ|@yield('title')</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>
<body data-background-color="bg2">
	<div class="wrapper fullheight-side no-box-shadow-style">
		<!-- Logo Header -->
		<div class="logo-header position-fixed" data-background-color="dark">

			<a href="index.html" class="logo">
				<img src="{{ asset('atlantis') }}/assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
			</a>
			<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
					<i class="icon-menu"></i>
				</span>
			</button>
			<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
			<div class="nav-toggle">
				<button class="btn btn-toggle toggle-sidebar">
					<i class="icon-menu"></i>
				</button>
			</div>
		</div>
		<!-- End Logo Header -->
		@include('partials.admin.sidebar')
		<!-- Navbar Header -->
		<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
			<div class="container-fluid">
				<nav class="navbar navbar-line navbar-header-left navbar-expand-lg p-0  d-none d-lg-flex">
					<ul class="navbar-nav page-navigation page-navigation-info">
						<li class="nav-item {{ request()->is('admin') ? 'active':'' }}">
							<a class="nav-link" href="{{ url('admin') }}">
								Dashboard
							</a>
						</li>
						<li class="nav-item {{ Route::is('admin.quotation*') ? 'active':''}}">
							<a class="nav-link" href="{{ url('admin/quotation') }}">
								Quotation
							</a>
						</li>
						<li class="nav-item {{ Route::is('admin.invoice*') ? 'active':''}}">
							<a class="nav-link" href="{{ url('admin/invoice') }}">
								Invoice
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								Delivery Order
							</a>
						</li>
                        <li class="nav-item">
							<a class="nav-link" href="#">
								Archive
							</a>
						</li>
					</ul>
				</nav>
				<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
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
											<h4>Hizrian</h4>
											<p class="text-muted">hello@example.com</p><a href="{{ url('logout') }}" class="btn btn-xs btn-secondary btn-sm">Logout</a>
										</div>
									</div>
								</li>
							</div>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<!-- End Navbar -->

		<div class="main-panel full-height">
			<div class="container">
				<div class="page-inner">
                    <h4 class="page-title">@yield('title')</h4>
					<div class="page-header justify-content-end">
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
                                <a href="{{ url('admin') }}">Dashboard</a>
                            </li>
                            @if (!request()->is('admin'))
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">@yield('title')</a>
                            </li>
                            @endif
                        </ul>
					</div>
                    @yield('content')
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="http://www.themekita.com">
									ThemeKita
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://www.themekita.com">ThemeKita</a>
					</div>
				</div>
			</footer>
		</div>
		<!-- Custom template | don't include it in your project! -->
		<div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="blue"></button>
							<button type="button" class="changeSideBarColor" data-color="purple"></button>
							<button type="button" class="changeSideBarColor" data-color="light-blue"></button>
							<button type="button" class="changeSideBarColor" data-color="green"></button>
							<button type="button" class="changeSideBarColor" data-color="orange"></button>
							<button type="button" class="changeSideBarColor" data-color="red"></button>
							<br/>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
							<button type="button" class="changeSideBarColor" data-color="blue2"></button>
							<button type="button" class="changeSideBarColor" data-color="purple2"></button>
							<button type="button" class="changeSideBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeSideBarColor" data-color="green2"></button>
							<button type="button" class="changeSideBarColor" data-color="orange2"></button>
							<button type="button" class="changeSideBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
							<button type="button" class="changeBackgroundColor" data-color="dark"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div>
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	@include('partials.admin.script')
</body>
</html>
