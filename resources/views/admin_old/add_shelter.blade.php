@extends('admin.layouts.admin_app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Shelter</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Add Shelter</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Alert Section -->
  @if(session('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
 
    {{session('success')}}
  </div>
  @endif

  @if(session('delete'))
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
 
    {{session('delete')}}
  </div>
  @endif
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    Enter address into the Map Search Engine <span><img src="{{url('Main/images/search.png')}}"></span> to populate your
    location. 
    <br>
    If you do not wish to disclose the exact address of the shelter, search for a proximate location.
  </div>


  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div style="height:300px" id="map" tabindex="0"></div>
      </div>
    </div>

    <div style="margin-top:10px;margin-bottom:10px" class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">General</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <form method="post" action="{{ url('/create_shelter') }}" id="create_shelter" role="form"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              <!--
                <div class="form-group">
                <label for="image">Shelter Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input required  name="image" type="file" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                    </div>
                </div>
              -->
              <div class="form-group">
                <label for="shelterName">Shelter Name</label>
                <input type="text" id="shelterName" name="shelterName" required class="form-control">
              </div>
              <div class="form-group">
                <label for="rooms">Availablity</label>
                <select id="rooms" name="rooms" class="custom-select group-select">
                  <option>Available</option>
                  <option>Not Available</option>
                </select>
              </div>

              <div class="form-group">
                <label for="contactNo1">Contact No</label>
                <input required type="text" id="contactNo1" name="contactNo1" class="form-control">
              </div>
              <div class="form-group">
                <label for="website">Website</label>
                <input required value="N/A" type="text" id="website" name="website" class="form-control">
                <small class="form-text text-muted">http://www.website.com</small>
              </div>
              <div class="form-group">
                <label for="shelterDescription">Shelter Description</label>
                <textarea id="shelterDescription" name="shelterDescription" class="form-control" rows="4"></textarea>
              </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Location</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="shelterCountry">Shelter Country</label>
              <select id="shelterCountry" name="shelterCountry" class="custom-select group-select">
                @foreach($countries as $con)
                <option>{{$con->country_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="shelterAddress">Shelter Address</label>
              <input required type="text" id="shelterAddress" name="shelterAddress" class="form-control">
            </div>
            <div class="form-group">
              <label for="shelterCity">Shelter City</label>
              <input required type="text" id="shelterCity" name="shelterCity" class="form-control">
            </div>
            <div class="form-group">
              <label for="shelterPostalCode">Shelter Postal Code</label>
              <input required type="text" id="shelterPostalCode" name="shelterPostalCode" class="form-control">
            </div>


            <input hidden required type="text" id="shelterLongitude" name="shelterLongitude" class="form-control">


            <input hidden required type="text" id="shelterLatitudes" name="shelterLatitudes" class="form-control">

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="form-group d-flex justify-content-center">
          <input onclick="return confirm('Is the information provided accurate (Country, City, Postal Code, etc.) ?')" type="submit" value="Create new Shelter" class="btn btn-success float-right">
        </div>
      </div>
    </div>


    </form>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
@section('script')
<script>
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

    //Instantiate with some options and add the Control
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
      var coord = ol.proj.toLonLat(evt.coordinate);
      console.log(evt);
      document.getElementById("shelterAddress").value = evt.address.details.name;
      document.getElementById("shelterCity").value = evt.address.details.city;
      document.getElementById("shelterPostalCode").value = evt.address.details.postcode;
      document.getElementById("shelterLongitude").value = coord[0];
      document.getElementById("shelterLatitudes").value = coord[1];
      window.setTimeout(function () {
        popup.show(evt.coordinate, evt.address.formatted);
      }, 3000);
    });




/*Click And Get Data */

map.on("singleclick", function (evt) {
    
    //map.removeLayer(vectorLayer);
    //vectorLayer.destroy();
    
    var coord = ol.proj.toLonLat(evt.coordinate);
    //document.getElementById("shelterPostalCode").value = evt.address.details.postcode;
    document.getElementById("shelterLongitude").value = coord[0];
    document.getElementById("shelterLatitudes").value = coord[1];
    
    showLocation(coord[0],coord[1]);

  var prettyCoord = ol.coordinate.toStringHDMS(
    ol.proj.transform(evt.coordinate, "EPSG:3857", "EPSG:4326"),
    2
  );
  
  popup.show(
    evt.coordinate,
    "<div><h2>Coordinates</h2><p>" + prettyCoord + "</p></div>"
  );
});

function showLocation(lon,lat){
		
    /*
		olview.animate({
			center: ol.proj.fromLonLat([lon, lat]),
			zoom:15,
		});
    */
    //map.removeLayer(vectorLayer);
      
		    vectorLayer = new ol.layer.Vector({
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


     // var test = document.getElementById("shelterLongitude").value;
      //console.info(document.getElementById("shelterLongitude").value);
    /*  
      var lon = coord[0];
      var lat = coord[1];
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
*/

</script>
<script>
  $(document).ready(function() {
  $('.group-select').select2();
});
</script>
@endsection