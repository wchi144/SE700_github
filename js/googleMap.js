// Adding 500 Data Points
var map, pointarray, heatmap, geocode;

var taxiData = [
  //new google.maps.LatLng(37.782551, -122.445368),
];

function initialize() {
  geocoder = new google.maps.Geocoder();
  var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(-36.9097, 174.7713),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

  var pointArray = new google.maps.MVCArray(taxiData);

  heatmap = new google.maps.visualization.HeatmapLayer({data: pointArray});

  heatmap.setMap(map);
}

//Function to get data from table and store in TaxiData array which is then used
//to creat the heatmap. Reload map after each iteration of table (which should 
//only be once). Google map has OVER_QUERY_LIMIT
//possible solution:
//https://developers.google.com/maps/documentation/business/articles/usage_limits
function codeAddress() {
    
    //Clear taxiData array on every new search
    taxiData.length = 0
    //Get data from table
    var oTBL = document.getElementById('results_table');
    
    for (var x = 1; x < oTBL.rows.length; x++) {
            var country = oTBL.rows[x].cells[0].firstChild.data;
            var city = oTBL.rows[x].cells[1].firstChild.data;
            var latlong = oTBL.rows[x].cells[2].firstChild.data;
            var ppl_cnt = oTBL.rows[x].cells[3].firstChild.data;
            
            var splitLatLng = latlong.split(",");
            var lat = splitLatLng[0];
            var long = splitLatLng[1];
            
            taxiData.push(new google.maps.LatLng(lat, long));
    } 
    heatmap.setMap(map);
}
  
//Testing function to see what is in TaxiData
function showData(){
    alert(taxiData);
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
  ].
  heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
}

function changeRadius() {
  heatmap.set('radius', heatmap.get('radius') ? null : 20);
}

function changeOpacity() {
  heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
}

google.maps.event.addDomListener(window, 'load', initialize);