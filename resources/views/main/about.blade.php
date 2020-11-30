@extends('main.layouts.main_header_2')
@section('content')

<style>
	.flip-card {
		background-color: transparent;
		width: 100%;
		height: 200px;
		perspective: 1000px;

	}

	.flip-card-inner {
		position: relative;
		width: 100%;
		text-align: center;
		transition: transform 0.6s;
		transform-style: preserve-3d;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);

	}

	.flip-card:hover .flip-card-inner {
		transform: rotateY(180deg);
	}

	.flip-card-front,
	.flip-card-back {
		position: absolute;
		width: 100%;
		height: 100%;
		padding-top: 40px;
		-webkit-backface-visibility: hidden;
		backface-visibility: hidden;

	}

	.flip-card-front {
		background-color: #bbb;
		color: black;
		padding: 5px;
	}

	.flip-card-back {
		background-color: #2980b9;
		color: white;
		transform: rotateY(180deg);
		padding: 5px;

	}
</style>

<div class="pagetop">
	<div class="container">
		<h1><i>Our Purpose</i></h1>
		<ul class="breadcrumbs">
			<li><a href="{{url('/')}}" title="">Home</a></li>
			<li>Our Purpose</li>
		</ul>
	</div>
</div>

<?php 
		$about_left=DB::table('contents')->where('status','1')->where('content_code' ,'about-left')->value('content');
		$about_right=DB::table('contents')->where('status','1')->where('content_code' ,'about-right')->value('content');
		?>
<section>
	<div class="block" style="background-color: white">
		<div class="container">
			<!--First Row -->
			<div class="row align-items-center">
				<div class="col-lg-4 col-md-12 ">
					<div class="flip-card">
						<div class="flip-card-inner" style="height: 240px">
							<div class="flip-card-front">
								<h6 style="font-size: 15px" class="col-title"><strong>{{$about_left}}</strong></h6>
							</div>
							<div class="flip-card-back">
								<h6>Please do not send it in as we have not beta tested it ourselves. After we test it
									ourselves, and approve then you can turn it in. There are other things that were on
									the list. Also... Add More text to the boxes other than hi and hello to see how much
									text the boxes can take and how they are influenced by more text. You can use this
									message as the test text. Thank you.</h1>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-12">

				</div>
				<div class="col-lg-4 col-md-12">
					<div class="flip-card">
						<div class="flip-card-inner" style="height: 240px">
							<div class="flip-card-front">
								<h6 style="font-size: 15px" class="col-title"><strong>{{$about_right}}</strong></h6>
							</div>
							<div class="flip-card-back">
								<h6>Please do not send it in as we have not beta tested it ourselves. After we test it
									ourselves, and approve then you can turn it in. There are other things that were on
									the list. Also... Add More text to the boxes other than hi and hello to see how much
									text the boxes can take and how they are influenced by more text. You can use this
									message as the test text. Thank you.</h6>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!--Second row-->
			<div class="row align-items-center">
				<div class="col-lg-4 col-md-12">

					<div class="flip-card">
						<div class="flip-card-inner" style="height: 200px">
							<div class="flip-card-front">
								<h6 style="font-size: 15px" class="col-title"><strong>Hello</strong></h6>
							</div>
							<div class="flip-card-back">
								<h1>Hi</h1>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-12">
					<div class="frame-im"><img src="{{asset('Main/images/candle.png')}}" alt="" /></div>
				</div>
				<div class="col-lg-4 col-md-12">
					<div class="flip-card">
						<div class="flip-card-inner" style="height: 240px">
							<div class="flip-card-front">
								<h6 style="font-size: 15px" class="col-title"><strong>Test</strong></h6>
							</div>
							<div class="flip-card-back">
								<h1>Test</h1>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Third Row -->
			<div class="row align-items-center">
				<div class="col-lg-4 col-md-12">

					<div class="flip-card">
						<div class="flip-card-inner" style="height: 200px">
							<div class="flip-card-front">
								<h6 style="font-size: 15px" class="col-title"><strong>Test</strong></h6>
							</div>
							<div class="flip-card-back">
								<h1>Test</h1>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-12">

				</div>
				<div class="col-lg-4 col-md-12">
					<div class="flip-card">
						<div class="flip-card-inner" style="height: 240px">
							<div class="flip-card-front">
								<h6 style="font-size: 15px" class="col-title"><strong>Test</strong></h6>
							</div>
							<div class="flip-card-back">
								<h1>Test</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<?php $about_rope=DB::table('contents')->where('status','1')->where('content_code' ,'about-rope')->value('content');  ?>
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



<!--
<section>
	<div class="block less-space coloured-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="bold-text">
					<h3>cvvbn</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
-->







@endsection