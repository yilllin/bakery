<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<meta name="author" content="SemiColonWeb">
	<meta name="description" content="Get Canvas to build powerful websites easily with the Highly Customizable &amp; Best Selling Bootstrap Template, today.">

	<!-- Font Imports -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=PT+Serif:ital@0;1&display=swap" rel="stylesheet">

	<!-- Core Style -->
	<link rel="stylesheet" href="{{asset('style.css')}}">

	<!-- Font Icons -->
	<link rel="stylesheet" href="{{asset('css/font-icons.css')}}">

	<!-- Plugins/Components CSS -->
	<link rel="stylesheet" href="{{asset('css/swiper.css')}}">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="favicon.ico">
	<link rel="shortcut icon" href="favicon.ico">
	<!-- Document Title
	============================================= -->
	<title>Bakery</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header semi-transparent dark">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo">
							<a href="{{ asset('/index') }}">
								<img class="logo-default" srcset="{{asset('images/logo.png')}}, {{asset('images/logo@2x.png 2x')}}" src="images/logo@2x.png" alt="Logo">
								<img class="logo-dark" srcset="{{asset('images/logo-dark.png')}}, {{asset('images/logo-dark@2x.png 2x')}}" src="images/logo-dark@2x.png" alt="Logo">
							</a>
						</div><!-- #logo end -->

						<div class="header-misc">
							
							@if ( session()->has('user_id') && session('user_type') == 'A')
								<a href="{{asset('product/manage')}}" class="me-3">管理商品</a>
								<a href="{{asset('user/ManagementCenter')}}" class="me-3">管理中心</a>
							@endif

							<div class="dropdown">
								<button class="btn btn-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="bi-person-circle" style="font-size: 24px;"></i>
								</button>
								
								<ul class="dropdown-menu" aria-labelledby="userDropdown">
									@if ( session()->has('user_id'))
									<li><a class="dropdown-item" href="{{ asset('user/MemberCenter') }}">會員中心</a></li>
									<li><a class="dropdown-item" href="{{ asset('/cart') }}">購物車</a></li>
									<li><a class="dropdown-item" href="{{ asset('user/signout') }}">登出</a></li>
									@else
									<li><a class="dropdown-item" href="{{ asset('user/account') }}">登入/註冊</a></li>
									@endif
								</ul>
							</div>

							<div id="top-cart" class="header-misc-icon">
								<a href="{{ asset('/cart') }}"><i class="bi-cart3"></i></a>
							</div>

						</div>

						<div class="primary-menu-trigger">
							<button class="cnvs-hamburger" type="button" title="Open Mobile Menu">
								<span class="cnvs-hamburger-box"><span class="cnvs-hamburger-inner"></span></span>
							</button>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu">

							<ul class="menu-container">
								<li class="menu-item">
									<a class="menu-link" href="{{ asset('/index') }}"><div>首頁</div></a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ asset('/index#about') }}"><div>關於我們</div></a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ asset('/product/menu') }}"><div>產品目錄</div></a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ asset('/contact') }}"><div>聯絡我們</div></a>
								</li>
							</ul>
						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->


        @yield('content') 

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row col-mb-30">

						<div class="col-md-6 text-center text-md-start">
							Copyrights &copy; 2024 yilin<br>
						</div>

						<div class="col-md-6 text-center text-md-end">
							<div class="d-flex justify-content-center justify-content-md-end mb-2">
								<a href="#" class="social-icon border-transparent si-small h-bg-facebook">
									<i class="fa-brands fa-facebook-f"></i>
									<i class="fa-brands fa-facebook-f"></i>
								</a>

								<a href="#" class="social-icon border-transparent si-small h-bg-twitter">
									<i class="fa-brands fa-twitter"></i>
									<i class="fa-brands fa-twitter"></i>
								</a>

								<a href="#" class="social-icon border-transparent si-small h-bg-instagram">
									<i class="fa-brands fa-instagram"></i>
									<i class="fa-brands fa-instagram"></i>
								</a>

								<a href="#" class="social-icon border-transparent si-small h-bg-google">
									<i class="fa-brands fa-google"></i>
									<i class="fa-brands fa-google"></i>
								</a>
							</div>

							<i class="bi-envelope"></i> bakery@gmail.com <span class="middot">&middot;</span> <i class="fa-solid fa-phone"></i> +886-123-456-789
						</div>

					</div>

				</div>
			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="uil uil-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="{{asset('js/functions.js')}}"></script>

</body>
</html>