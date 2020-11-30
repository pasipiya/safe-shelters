<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>DmvSafe - Find your shelter</title>
	<link rel="icon" href="{{url('Main/images/logo.png')}}" type="image/gif">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="_token" content="{{ csrf_token() }}">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{asset('Main/css/bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{asset('Main/css/icons.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('Main/css/style.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('Main/css/responsive.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('Main/css/color.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('Main/revolution/css/settings.css')}}">
	<!--<link rel="stylesheet" type="text/css" href="{{asset('OpenLayerMap/ol.css')}}" />-->
	<!--Select2-->
	<link href="{{asset('AdminLTE/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />

	<!--OpenLayers CSS-->
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/openlayers/dist/ol.css" />
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/ol-geocoder@4.0.0/dist/ol-geocoder.min.css" />
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/ol-popup@2.0.0/src/ol-popup.css" />

	<script>
		function Navigate() {
            location.replace("https://www.google.com/");
            return false;
        }
	</script>

</head>

<body>

	<header>
		<div class="menubar">
			<div class="row align-items-center">
				<div class="col-3">
					<div class="logo"><a href="{{url('/')}}">

							<h1 style="color:#000080"><img style="margin-right: 8px;margin-top:-12%" width="60%"
									src="{{url('Main/images/logo.png')}}" alt="" /></h1>
						</a></div>
				</div>

				<div class="col-9">

					<nav>
						<ul>

							<li><a href="{{url('/')}}" title="">Home</a></li>
							@if(Auth::user())
							<li><a href="{{url('/home')}}" title="">Dashboard</a></li>
							@endif
							<li><a href="{{url('/about')}}" title="">Our Purpose</a></li>

							<li><a href="{{url('contact')}}" title="">Contact Us</a></li>
							<li><a href="{{ url('registration') }}" title="">Register Shelter Org</a></li>
							<li><button
									style="width: 100px;height:50px;margin-right:20%;margin-top:-10px;padding-top:10px"
									class="top-btn" onclick="Navigate()"><img
										src="{{url('Main/images/close.png')}}"></button>
								<h6 style="padding-top: 50px;font-size: 0.8vw;">Click above to leave the site.<br>It
									redirects to Google.</h6>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div><!-- Menu Bar -->
	</header><!-- Header -->



	<div class="responsive-header">
		<div class="topbar">
			<button class="top-btn" onclick="Navigate()" title="">Click above to leave the site. It redirects to
				Google.</button>
			<ul>
				<li><a href="{{ url('registration') }}" title="">Register Shelter Org</a></li>

			</ul>
		</div>

		<div class="responsive-menubar">

			<div class="row align-items-center">
				<div class="col-9">
					<div class="logo"><a href="{{url('/')}}" title="">

							<h2 style="color:#000080;margin-bottom:0px"><img style="margin-right: 8px;margin-top:4%"
									width="60%" src="{{url('Main/images/logo.png')}}" alt="" />
							</h2>
						</a></div>
				</div>
				<div class="col-3">
					<a class="responsive-menu-btn" href="#" title=""><i class="ion-navicon"></i></a>
				</div>
			</div>
			<!--
			<div class="logo"><a href="{{url('/')}}" title="">

					<h2 style="color:#000080">DMVSafe
					</h2>
				</a></div>

			<a class="responsive-menu-btn" href="#" title=""><i class="ion-navicon"></i></a>
			-->
		</div>


		<div class="sideheader">
			<a class="menu-btn close" href="javascript:void(0)" title=""><i class="icon-cancel"></i></a>
			<div class="sidemenu scrollbar">
				<ul>
					<li><a href="{{url('/')}}" title="">Home</a></li>
					<li><a href="{{url('/about')}}" title="">Our Purpose</a></li>
					<li><a href="{{url('contact')}}" title="">Contact Us</a></li>
				</ul>
			</div>
		</div>
	</div>

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
								<?php /* echo $contact; */ ?>
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
	</script>



	<script src="{{asset('Main/js/slick.min.js')}}"></script>
	<script src="{{asset('Main/js/simpleLightbox.min.js')}}"></script>
	<script src="{{asset('Main/js/select2.min.js')}}"></script>

	<!--OpenLayers-->
	<script src="https://unpkg.com/openlayers@4.6.5/dist/ol.js"></script>
	<script src="https://unpkg.com/ol-geocoder@4.0.0/dist/ol-geocoder.js"></script>
	<script src="https://unpkg.com/ol-popup@2.0.0/src/ol-popup.js"></script>
	<script src="{{asset('Main/js/script.js')}}"></script>


	@yield('script')


</body>

</html>