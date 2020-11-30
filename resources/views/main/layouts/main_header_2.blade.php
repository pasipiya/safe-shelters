<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>DmvSafe - Find Shelter</title>
	<link rel="icon" href="{{url('Main/images/logo.png')}}" type="image/gif">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{asset('Main/css/bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{asset('Main/css/icons.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('Main/css/style.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('Main/css/responsive.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('Main/css/color.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('OpenLayerMap/ol.css')}}" />
	<script>
		function Navigate() {
            location.replace("https://www.google.com/");
            return false;
        }
	</script>
</head>

<body>
	<header class="transparent">
		<div class="row align-items-center">
			<div class="col-3">
				<div class="logo"><a href="{{url('/')}}" title="">
						<img style="margin-right: 8px;margin-top:-12%" width="60%" src="{{url('Main/images/logo.png')}}"
							alt="" />
						<h1 style="color: white"></h1>
					</a></div>
			</div>
			<div class="col-6">
				<nav style="padding-top: 45px">
					<ul>
						<li><a href="{{url('/')}}" title="">Home</a></li>
						<li><a href="{{url('/about')}}" title="">Our Purpose</a></li>
						<li><a href="{{url('contact')}}" title="">Contact Us</a></li>
						<li><button style="width: 100px;margin-right:25px;height:50px;padding-left:32px;padding-top:9px"
								class="top-btn" onclick="Navigate()"><img
									src="{{url('Main/images/close.png')}}"></button>
							<h6 style="padding-top: 40px;font-size: 0.8vw;color:white">Click above to leave the
								site.<br>It redirects to Google.</h6>
						</li>
					</ul>
				</nav>
			</div>
			<div class="col-3">

				<div class="social-btns">
					<a class="facebook" href="https://www.facebook.com/safe.np.12" title=""><i
							class="fa fa-facebook"></i></a>
					<a class="twitter" href="https://twitter.com/DmvSafe" title=""><i class="fa fa-twitter"></i></a>
					<a class="pinterest" href="https://www.pinterest.com/dmvsafe/" title=""><i
							class="fa fa-pinterest"></i></a>
					<a class="instagram" href="https://www.instagram.com/dmvsafe/" title=""><i
							class="fa fa-instagram"></i></a>
					<a class="instagram" href="https://www.linkedin.com/in/dmvsafe-llc-1ba2311ab/" title=""><i
							class="fa fa-linkedin"></i></a>
				</div>
			</div>
		</div>
	</header><!-- Header -->

	<div class="responsive-header">
		<div class="topbar">
			<button class="top-btn" onclick="Navigate()" title="">Click above to leave the site. It redirects to
				Google.</button>
			<ul>
				<li><a href="{{ url('registration') }}" title="">Register Shelter Org.</a></li>
			</ul>
		</div><!-- Topbar -->
		<div class="responsive-menubar">
			<div class="row align-items-center">
				<div class="col-9">
					<div class="logo"><a href="{{url('/')}}" title="">

							<h2 style="color:#000080;margin-bottom:0px"><img style="margin-right: 8px;margin-top:1%"
									width="60%" src="{{url('Main/images/logo.png')}}" alt="" />
							</h2>
						</a></div>
				</div>
				<div class="col-3">
					<a class="responsive-menu-btn" href="#" title=""><i class="ion-navicon"></i></a>
				</div>
			</div>
		</div><!-- Responsive Menubar -->


		<div class="sideheader">
			<a class="menu-btn close" href="javascript:void(0)" title=""><i class="icon-cancel"></i></a>
			<div class="sidemenu scrollbar">
				<ul>
					<li><a href="{{url('/')}}" title="">Home</a></li>
					<li><a href="{{url('/about')}}" title="">Our Purpose</a></li>
					<li><a href="{{url('contact')}}" title="">Contact Us</a></li>
				</ul>
			</div>
		</div><!-- Sideheader -->
	</div><!-- Responsive Header -->

	@yield('content')


	<footer>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="widget">
							<div class="about-widget">
								<div class="logo"><a href="{{url('/')}}" title="">
										<h1 style="color: white"><img style="margin-right: 8px;" width="60%"
												src="{{url('Main/images/logo.png')}}" alt="" /></h1>
									</a></div>
								<p>For more information, visit our contact page. </p>

							</div><!-- About Widget -->
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="widget">
							<h3 class="widget-title">Useful Links</h3>
							<ul>
								<li><a href="{{url('/')}}" title="">Home</a></li>
								<li><a href="{{url('/about')}}" title="">Our Purpose</a></li>
								<li><a href="{{url('/contact')}}" title="">Contact Us</a></li>

							</ul>
						</div>
					</div>
					<?php $contact=DB::table('contents')->where('status','1')->where('content_code' ,'contact')->value('content');  ?>
					<div class="col-lg-3 col-md-6">
						<div class="widget">
							<a href="{{url('/about')}}" title="">
								<h3 class="widget-title">About DmvSafe</h3>
							</a>
							<ul>
								<?php //echo $contact ?>
							</ul>
						</div>
					</div>

					<div class="col-lg-2 col-md-6">
						<div class="widget">
							<h3 class="widget-title">Exit Website</h3>
							<ul>
								<li><button class="btn" onclick="Navigate()"><img
											src="{{url('Main/images/close.png')}}"></button></li>
								<li>Click above to leave the site. It redirects to Google.</li>
							</ul>
						</div>
					</div>

				</div>

			</div>
		</div>
	</footer>


	<div class="bottombar">
		<div class="container">
			<p>© 2020 DmvSafe is Powered by <a href="#" title="">OpenLayersMap</a> </p>
			<div class="socials">
				<a href="https://www.facebook.com/safe.np.12" title="">Facebook</a>
				<a href="https://twitter.com/DmvSafe" title="">Twitter</a>
				<a href="https://www.pinterest.com/dmvsafe/" title="">Pinterest</a>
				<a href="https://www.instagram.com/dmvsafe/" title="">Instagram</a>
				<a href="https://www.linkedin.com/in/dmvsafe-llc-1ba2311ab/" title="">Linkedin</a>
			</div>
		</div>
	</div>





	<script src="{{asset('Main/js/jquery.min.js')}}"></script>
	<script src="{{asset('Main/js/slick.min.js')}}"></script>
	<script src="{{asset('Main/js/simpleLightbox.min.js')}}"></script>
	<script src="{{asset('OpenLayerMap/ol.js')}}"></script>
	<script src="{{asset('Main/js/script.js')}}"></script>

	@yield('script')
</body>

</html>