@extends('main.layouts.main_header_1')
@section('content')
<style>
	/*Box*/
	.box {
		background-color: #b6f2f2;
		margin-top: 15px;
		border-radius: 5px;

	}

	.centerBlock {
		display: table;
		margin: auto;
	}

	.showLocation {

		font-size: 18px;
		padding: 8px 30px;
		color: #fff;
		border-radius: 4px;
		background: #000080;
		border: 0;
	}

	/* Formatting search box */
	.search-box {
		width: 100%;
		position: relative;
		display: inline-block;
		font-size: 14px;
	}

	.search-box input[type="text"] {
		height: 50px;
		padding: 5px 10px;
		border: 1px solid rgb(221, 20, 154);
		font-size: 14px;
	}

	.result {
		position: static;
		z-index: 999;
		top: 100%;
		left: 0;

	}

	.search-box input[type="text"],
	.result {
		width: 100%;
		box-sizing: border-box;
	}

	/* Formatting result items */
	.result p {
		font-weight: bold;
		color: blue;
		margin: 0;
		padding: 7px 10px;
		border: 1px solid rgb(197, 43, 43);
		border-top: none;
		cursor: pointer;
	}

	.result p:hover {
		background: #1eb851;
	}

	div.ex1 {
		background-color: lightblue;
		width: 100%;
		height: 100vh;
		overflow: scroll;
	}

	.s_result p {
		margin-bottom: 0px;
	}
</style>

<section>
	<div class="block blackish">
		<div class="fixed-bg bg1"></div>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10">
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
					<div class="find-shelter">
						<?php $header=DB::table('contents')->where('status','1')->where('content_code' ,'index-header')->value('content');  ?>
						<h3>{{$header}}</h3>
						<!--	<input  placeholder="Country,Address,ZipCode" /> -->
						<form method="get" action="{{url('/search_shelter')}}">
							{{ csrf_field() }}

							<div style="margin-left:10px;width:100%;" class="search-box">
								<select id="shelterCountry" name="shelterCountry" class="group-select">
									<option>Please choose country</option>
									@foreach($countries as $con)
									<option>{{$con->country_name}}</option>
									@endforeach
								</select>
							</div>

							<div class="search-box">
								<input name="search" id="search" type="text" autocomplete="off"
									placeholder="To narrow search, enter a postal code or city" />
								<div class="result"></div>
							</div>
							<button style="margin-top:10px" class="btn large" type="submit">Search</button>
						</form>

					</div><!-- Find Shleter -->
				</div>
			</div>
		</div>
	</div>
</section>
<br><br><br>



<section>
	<div class="block gray">
		<div class="container">
			<div class="row">

				<div class="col-12">
					<div class="title">
						<div class="row">
							<div style="margin-bottom:30px" class="col-12 col-md-6">
								<h2><i>Local </i>Shelters</h2>
							</div>
							<div class="col-12 col-md-6">
								<button onclick="Navigate()" style="font-size: 10px;"
									class="btn btn-default btn-lg btn-block">Click here to
									leave the site. It redirects to Google</button>
							</div>
						</div>
					</div>

					<div class="row">
						<div style="border-style: solid;
						border-color:blue;
						border-width: 6px;" class="col-12 col-sm-12 col-lg-8 d-flex justify-content-center">
							<div class="ex1">

								<!--Search Results-->


								<div class="row d-flex justify-content-center">
									@if(isset($search_data))
									@foreach ($search_data as $row)
									<div class="col-12 col-md-6">

										<div class="card" style=" margin:10px; border-style: solid;
										border-color:blue;
										border-width: 1px;">
											<div class="card-body s_result">
												<h5 class="card-title">{{$row->shel_name}}</h5>
												<p class="card-text"><span
														style="color: black;font-weight: bold;">Address:
													</span><br>{{$row->shel_address}}</p>
												<hr>

												<p class="card-text"><span style="color: black;font-weight: bold;">Phone
														No:
													</span>{{$row->shel_contact_1}}
												</p>
												<hr>

												<p class="card-text"><span
														style="color: black;font-weight: bold;">Website : </span><br>
													<a target="_blank" href="{{$row->website}}">{{$row->website}}</a>
												</p>
												<hr>

												<p class="card-text"><span
														style="color: black;font-weight: bold;">Description:
													</span><br>{{$row->shel_description}}
												</p>
												<hr>


												<input hidden name="lon" value="{{$row->shel_longitude}}">
												<input hidden name="lat" value="{{$row->shel_latitude}}">
												<br>
												<a style="" class="showLocation" href="#map" id="showLocation"
													onclick="showLocation({{$row->shel_longitude}},{{$row->shel_latitude}})">Find
													Location</a>

											</div>

										</div>

									</div>

									@endforeach
									@endif

								</div>

							</div>
						</div>
						<div class="col-12 col-sm-12 col-lg-4" id="map" style=" width: 100%; border-style: solid;
						border-color:blue;
						border-width: 6px;">

						</div>
					</div>



					<!--	<div id="popup" class="ol-popup">
								<a href="#" id="popup-closer" class="ol-popup-closer"></a>
								<div id="popup-content"></div>
							  </div>-->
				</div>
			</div>
		</div>
	</div>
</section>





@endsection
@section('script')
<script>
	$(document).ready(function() {
			$('.group-select').select2();
		  });
</script>
<script>
	$(document).ready(function(){
		$('.search-box input[type="text"]').on("keyup input", function(){
			/* Get input value on change */
			var query = $(this).val();
			var resultDropdown = $(this).siblings(".result");
			if(query.length){
				var data;
					// Display the returned data in browser

					$.ajax({
  						url:"{{ route('live_search') }}",
  						method:'GET',
  						data:{query:query},
  						dataType:'json',
  						success:function(data)
  						{
							resultDropdown.html(data.table_data);
  						}
 							})

					
			  
			} else{
				resultDropdown.empty();
			}
		});
		
		// Set search input value on click of result item
		$(document).on("click", ".result p", function(){
			$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
			$(this).parent(".result").empty();
		});
	});
</script>





<script>
	var map;

    var mapLat = 44.500000;
	var mapLng = 51.5077286;
    var markers=[];
	var lon;
	var lat;
	
	var app = @json($shel_data);
	app.forEach(item => markers.push({0:item.shel_longitude,1:item.shel_latitude}));


	var olview = new ol.View({ center: [0, 0], zoom: 2 }),
		  baseLayer = new ol.layer.Tile({ source: new ol.source.OSM() }),
		  map = new ol.Map({
			target: document.getElementById("map"),
			view: olview,
			layers: [baseLayer],
		  });


		// popup
		var popup = new ol.Overlay.Popup();
		map.addOverlay(popup);
	
	  
	function showLocation(lon,lat){
		
		olview.animate({
			//centerOn:[lon,lat],
			center: ol.proj.fromLonLat([lon, lat]),
			zoom:15,
		});

		var vectorLayer = new ol.layer.Vector({
        source:new ol.source.Vector({
          features: [new ol.Feature({
                geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lon), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
            })]
        }),
        style: new ol.style.Style({
          image: new ol.style.Icon({
            anchor: [0.5, 0.5],
            anchorXUnits: "fraction",
            anchorYUnits: "fraction",
            src: "https://img.icons8.com/bubbles/50/000000/worldwide-location.png"
          })
        })
      });
      map.addLayer(vectorLayer); 

			
		

	}


		//Instantiate with some options and add the Control
		/*
		var geocoder = new Geocoder("nominatim", {
		  provider: "osm",
		  lang: "en",
		  placeholder: "Search for ...",
		  limit: 5,
		  debug: false,
		  autoComplete: true,
		  keepOpen: true,
		});
		map.addControl(geocoder);
	
		//Listen when an address is chosen
		geocoder.on("addresschosen", function (evt) {
		  window.setTimeout(function () {
			popup.show(evt.coordinate, evt.address.formatted);
		  }, 3000);
		});
		*/

/*
	for (var i=0; i<markers.length; i++) {
      
      var lon = markers[i][0];
      var lat = markers[i][1];

      var vectorLayer = new ol.layer.Vector({
        source:new ol.source.Vector({
          features: [new ol.Feature({
                geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lon), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
            })]
        }),
        style: new ol.style.Style({
          image: new ol.style.Icon({
            anchor: [0.5, 0.5],
            anchorXUnits: "fraction",
            anchorYUnits: "fraction",
            src: "https://upload.wikimedia.org/wikipedia/commons/e/ec/RedDot.svg"
          })
        })
      });
      map.addLayer(vectorLayer); 
	  
        }

*/






	/*Click And Get Data */
	/*
	map.on("singleclick", function (evt) {
		
		var coord = ol.proj.toLonLat(evt.coordinate);
	  var prettyCoord = ol.coordinate.toStringHDMS(
		ol.proj.transform(evt.coordinate, "EPSG:3857", "EPSG:4326"),
		2
	  );
	  
	  popup.show(
		evt.coordinate,
		"<div><h2>Coordinates</h2><p>" + prettyCoord + "</p></div>"
	  );
	});	
	*/

</script>




@endsection