@extends('main.layouts.main_header_2')
@section('content')
<div class="pagetop">
	<div class="container">
		<h1><i>Contact</i> Us</h1>
		<ul class="breadcrumbs">
			<li><a href="{{url('/')}}" title="">Home</a></li>
			<li>Contact Us</li>
		</ul>
	</div>
</div>

<section style="margin-top: 50px">
	<div class="block no-padding">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="shelter-call">
						<div class="row">
							<div class="col-lg-8 col-md-12">
								<p style="color: blue">Please <i>fill the form below,</i> We will respond soon.</p>
							</div>
							<div class="col-lg-4 col-md-12">
								<div class="call-now">
									<i class="fa fa-phone"></i>
									<span><i style="color: blue">Call Now:</i> 404-594-1359</span>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 col-md-12">
								<!-- Alert Section -->
								@if(session('success'))
								<div class="alert alert-success alert-dismissible">
								
									{{session('success')}}
								</div>
								@endif

								@if(session('delete'))
								<div class="alert alert-danger alert-dismissible">
							
									{{session('delete')}}
								</div>
								@endif
							</div>
						</div>
					</div><!-- Shelter Call -->
				</div>
			</div>
		</div>
	</div>
</section>


<section>
	<div class="block no-padding">
		<div class="row">
			<div class="col-md-12">
				<div class="shelter-contact">

					<div class="simple-form">
						<form method="post" action="{{url('/send_message')}}">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-12"><input required name="name" type="text"
										placeholder="Full Name" /></div>
								<div class="col-md-12"><input required name=email type="email" placeholder="Email" />
								</div>
								<div class="col-md-12"><input required name="subject" type="text"
										placeholder="Subject" /></div>
								<div class="col-md-12"><textarea required name="msg" placeholder="Message"></textarea>
								</div>
								<div class="col-md-12"><button class="btn" type="submit">Send Message</button></div>
							</div>
						</form>
					</div><!-- Contact Form -->
				</div><!-- Shelter Contact -->
			</div>
		</div>
	</div>
</section>

<?php $about_rope=DB::table('contents')->where('status','1')->where('content_code' ,'contact-rope')->value('content');  ?>
<section>
<!--
	<div class="block less-space coloured-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="bold-text">
						<h3>{{$about_rope}}</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
-->
	<div class="pagetop">
		<div class="container">
			<h3 style="color: white">{{$about_rope}}</h3>
		</div>
	</div>

</section>
@endsection