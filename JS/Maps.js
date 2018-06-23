function myMap() {
	var mapCanvas = document.getElementById("map");
	var myCenter = new google.maps.LatLng(45.13985388501425,12.086511254310608); 
	var mapOptions = {center: myCenter, zoom: 16};
	var map = new google.maps.Map(mapCanvas,mapOptions);
	var marker = new google.maps.Marker({
		position: myCenter
	});
	marker.setMap(map);
	//Zoom a 18 quando si clicca nel marker 
	google.maps.event.addListener(marker,'click',function() {
		map.setZoom(18);
		map.setCenter(marker.getPosition());
	});
}				