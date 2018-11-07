@extends('layouts.app')

@section('content')
	<section class="section">
	  <h1 class="section-header">
	    <div>Maps</div>
	  </h1>
	  <div class="row">
		  <div class="col-12">
        <div id="map" style="width:100%;height: 400px;"></div>
  	  </div>
    </div>
	</section>
@endsection

@section('js')
<script type="text/javascript">
	//Deklarasi Map
	@foreach($data as $data)
	var lat[] = "{{ $data['lat'] }}"
	var long[] = "{{ $data['long'] }}"
		var mymap = L.map('map').setView([lat,long], 15);

			L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
				attribution: 'Map data&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				maxZoom: 18,
				id: 'mapbox.streets',
				accessToken: 'pk.eyJ1IjoibWFyY2VsbGthbGl0b3V3IiwiYSI6ImNqbWM3Z2k4OTA3NXIza256OWY4MXM1cWQifQ.ZuXcoyil-xRQl1JRGdl69g'
			}).addTo(mymap);


	var marker = L.marker([lat,long]).addTo(mymap);
	var titik = L.marker([lat,long]).addTo(mymap);

	var circle = L.circle([lat,long], {
		color : 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius:500
	}).addTo(mymap);

	
	@endforeach

	marker.bindPopup("Lokasi Kebakaran!").openPopup();
	circle.bindPopup("ini sebuah circle.");
	titik.bindPopup("<b>Lokasi Kebakaran <b>").addTo(mymap);

	var popup = L.popup();
	function onMapClick(e) {popup
		.setLatLng(e.latlng)
		.setContent("Lokasi yang dipilih: " + e.latlng.toString())
		.openOn(mymap);
	}

	mymap.on('click', onMapClick);

</script>
@endsection
