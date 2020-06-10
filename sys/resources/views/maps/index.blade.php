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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTKXb5Q14HUjhtIpPprV5iXA84KdO81Yo&callback=initMap" async defer></script>
<script>
	function initMap() {
		var kantor = {
			lat: 1.445948,
			lng: 125.183886
		};
		var lats = "{{ $data['lat'] }}";
		var long = "{{ $data['long'] }}";
		var locations = [
			['Kantor Kebakaran', 1.445948, 125.183886, 4, '<h3>Kantor Kebakaran</h3><p>Ini Kantor Kebakaran</p>', '{{ asset('assets/img/fire.jpg ') }}'],
			['Lokasi Kebakaran', lats, long, 5, '<h3>Lokasi Kebakaran</h3><p>Ini Lokasi Kebakaran</p>', '{{ asset('assets/img/fire.png') }}'],
		];
		var map = new google.maps.Map(
			document.getElementById('map'), {
				zoom: 14,
				center: kantor,
				mapTypeControl: false,
				streetViewControl: false
			});
		var directionsService = new google.maps.DirectionsService();
		var directionsDisplay = new google.maps.DirectionsRenderer();
		directionsDisplay.setOptions({
			suppressMarkers: true
		});
		directionsDisplay.setMap(map);
		var awal = new google.maps.LatLng(1.445948, 125.183886);
		var tujuan = new google.maps.LatLng(lats, long);
		var request = {
			origin: kantor,
			destination: tujuan,
			travelMode: 'DRIVING'
		};
		directionsService.route(request, function (result, status) {
			if (status == 'OK') {
				directionsDisplay.setDirections(result);
				var _route = result.routes[0].legs[0];
				var iconA = {
					url: "{{ asset('assets/kantor.png') }}", // url
					scaledSize: new google.maps.Size(25, 25), // scaled size// anchor
				};
				var iconB = {
					url: "{{ asset('assets/titik.png') }}", // url
					scaledSize: new google.maps.Size(25, 25), // scaled size/ anchor
				};
				pinA = new google.maps.Marker({
						position: _route.start_location,
						map: map,
						title: 'Kantor Kebakaran',
						infoWindow: {
							content: '<h3>Kantor Kebakaran</h3><p>Ini Kantor Kebakaran</p>'
						},
						icon: iconA
					}),
					pinB = new google.maps.Marker({
						position: _route.end_location,
						map: map,
						title: 'Lokasi Kebakaran',
						infoWindow: {
							content: '<h3>Lokasi Kebakaran</h3><p>Ini Lokasi Kebakaran</p>'
						},
						icon: iconB
					});
				console.log(result);
				var hitung = computeTotalDistance(result);
				var step = Math.floor(result.routes[0].legs[0].steps.length / 2);
				var infowindow2 = new google.maps.InfoWindow();
				infowindow2.setContent("Jarak " + hitung.jarak + "<br>" + "Perkiraan Waktu " + hitung.waktu + " ");
				infowindow2.setPosition(result.routes[0].legs[0].steps[step].end_location);
				infowindow2.open(map);

			}
		});


	}
</script>
<script>
function computeTotalDistance(result) {
		var tokens = "{{ $user['token'] }}";
		var total = 0;
		var totalDuration = 0;
		var myroute = result.routes[0];
		for (var i = 0; i < myroute.legs.length; i++) {
			total += myroute.legs[i].distance.value;
			totalDuration += myroute.legs[i].duration.value;
		}
		total = total / 1000;
		totalDuration = totalDuration / 60;
		console.log(total.toFixed(1) + ' km');
		console.log(Math.round(totalDuration) + ' Menit');
		$.post("{{ route('laapor.store') }}", {
			'_token': $('meta[name=csrf-token]').attr('content'),
			'userToken': tokens,
			'jarak': total.toFixed(1) + ' km',
			'waktu': Math.round(totalDuration) + ' Menit'
		})
		.done(function(data){
			console.log(data);
			alert("Berhasil Mengirim Notifikasi Ke User");
		})
		.fail(function(data){
			console.log(data);
			alert("Gagal Mengirim Notifikasi Ke User");
		})
		var objek = {};
		objek["jarak"] = total.toFixed(1) + ' km';
		objek["waktu"] = Math.round(totalDuration) + ' Menit';
		return objek;
	}
</script>
@endsection