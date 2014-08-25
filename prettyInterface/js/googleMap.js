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
  
  var homeControlDiv = document.createElement('div');
  var homeControl = new HomeControl(homeControlDiv, map);
  homeControlDiv.index = 1;
  
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
  
  var pointArray = new google.maps.MVCArray(taxiData);
  
  heatmap = new google.maps.visualization.HeatmapLayer({data: pointArray});

  heatmap.setMap(map);
  
  
  
}
//google.maps.event.addDomListener(window, 'load', initialize);
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
            
            for (i = 0; i < ppl_cnt; i++) {
                taxiData.push(new google.maps.LatLng(lat, long));
            }
            
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

function TextualZoomControl() {
}

function HomeControl(controlDiv, map) {

  // Set CSS styles for the DIV containing the control
  // Setting padding to 5 px will offset the control
  // from the edge of the map
  controlDiv.style.padding = '5px';

  // Set CSS for the control border
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = '#83d3c9';
  controlUI.style.borderColor = "#83d3c9";
  controlUI.style.width = "36px";
  controlUI.style.height = "36px";
  controlUI.style.cursor = 'pointer';
  controlUI.style.textAlign = 'center';
  controlUI.style.verticalAlign = "middle";
  controlUI.title = 'Reload Map';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior
  /*var controlText = document.createElement('div');
  controlText.style.fontFamily = 'Arial,sans-serif';
  controlText.style.fontSize = '12px';
  controlText.style.paddingLeft = '4px';
  controlText.style.paddingRight = '4px';
  controlText.innerHTML = '<b>Home</b>';
  controlUI.appendChild(controlText);*/
  
  var controlContent = document.createElement('button');
  controlContent.className = "customizeButton";
  controlContent.style.width = "36px";
  controlContent.style.height = "36px";
  controlUI.appendChild(controlContent);
  
  var controlInner = document.createElement('span');
  controlInner.className = "fa fa-refresh fa-spin fa-lg";
  controlInner.style.margin = "0";
  controlInner.style.padding = "0";
  controlContent.appendChild(controlInner);

  // Setup the click event listeners: simply set the map to
  // Chicago
  google.maps.event.addDomListener(controlUI, 'click', function() {
    codeAddress();
  });

}