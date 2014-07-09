// Adding 500 Data Points
var map, pointarray, heatmap;

var taxiData = [];

function initialize() {
  var mapOptions = {
    zoom: 13,
    center: new google.maps.LatLng(37.774546, -122.433523),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById('map_canvas'),
      mapOptions);

  var pointArray = new google.maps.MVCArray(taxiData);

  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray
  });

  heatmap.setMap(map);
}

function updateCoordinates() {

    var table = $("table tbody");
    table.find('tr').each(function (i, el) {
        var $tds = $(this).find('td'),
            country = $tds.eq(0).text(),
            city = $tds.eq(1).text(),
            ppl_count = $tds.eq(2).text();
        
			country = country.toLowerCase();
			city = city.toLowerCase();
			
		    var geocoder =  new google.maps.Geocoder();
			geocoder.geocode( { 'address': 'miami, us'}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var lat = results[0].geometry.location.lat();
					var lng = results[0].geometry.location.lng(); 
				} else {
					alert("Something got wrong " + status);
				}
			});
		for (var i=0; i<ppl_count; i++){
			//regenerate heatmap by adding coocrdinates
			pointArray.push(new LatLng(lat, lng));		
		}
    });

}

function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
  var gradient = [
    'rgba(0, 255, 255, 0)',
    'rgba(0, 255, 255, 1)',
    'rgba(0, 191, 255, 1)',
    'rgba(0, 127, 255, 1)',
    'rgba(0, 63, 255, 1)',
    'rgba(0, 0, 255, 1)',
    'rgba(0, 0, 223, 1)',
    'rgba(0, 0, 191, 1)',
    'rgba(0, 0, 159, 1)',
    'rgba(0, 0, 127, 1)',
    'rgba(63, 0, 91, 1)',
    'rgba(127, 0, 63, 1)',
    'rgba(191, 0, 31, 1)',
    'rgba(255, 0, 0, 1)'
  ]
  heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
}

function changeRadius() {
  heatmap.set('radius', heatmap.get('radius') ? null : 20);
}

function changeOpacity() {
  heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
}

google.maps.event.addDomListener(window, 'load', initialize);