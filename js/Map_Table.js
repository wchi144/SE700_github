/* 
 * Load results of sql search
 * Two Parts
 * -Map Results using Google Map API
 * -Pass input from prototypePage.php to search_inputs, search_outputs, show_tweets, and fetch_page for querying
 * By Shiyi Zhang and Wei-Ling Chin
 */

/*
 * Create heat map using Google Map API
 */
// Adding 500 Data Points
var map, pointarray, heatmap, geocode;

//Array with location information (longitude and latitude pair coordinates)
var taxiData = [
  //new google.maps.LatLng(37.782551, -122.445368),
];

//initialise google map 
function initialize() {
  geocoder = new google.maps.Geocoder();
  var mapOptions = {
    zoom: 2,
    //center: new google.maps.LatLng(-36.9097, 174.7713),
    center: new google.maps.LatLng(-0.0000, -160.0000),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  
  //Show on map_canvas in prototypePgae.php
  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

  var pointArray = new google.maps.MVCArray(taxiData);
  
  heatmap = new google.maps.visualization.HeatmapLayer({data: pointArray});
  
  //reload map
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
    
    //Get all data from results table
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
    //heatmap.setMap(map);
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
  controlDiv.style.padding = '6px';
  
  var controlContent = document.createElement('button');
  controlContent.title = 'Reload Map';
  controlContent.className = "customizeButton";
  controlContent.style.width = "36px";
  controlContent.style.height = "37px";
  controlContent.style.padding="0";
  controlContent.style.margin="0";
  controlDiv.appendChild(controlContent);
  
  var controlInner = document.createElement('i');
  controlInner.className = "fa fa-refresh fa-spin fa-2x";
  controlInner.style.width="100%";
  controlInner.style.height="100%";
  controlInner.style.margin = "0";
  controlInner.style.padding = "4px 1px 2px 2px";
  controlContent.appendChild(controlInner);

  // Setup the click event listeners: simply set the map to
  // Chicago
  google.maps.event.addDomListener(controlContent, 'click', function() {
    codeAddress();
  });

}

//Back up to reload map for backup "Map" button in prototypePage
function showMap() {
    
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

/*
 * Pass input from prototypePage.php to php files which queries the database
 */
function load_results_1(){
    
    //Delete previous results from all tables
    var elmtTable = document.getElementById('results_table');  
    for (var i = 1; i < elmtTable.rows.length; i++)
    {
         elmtTable.deleteRow(i);
    }   
    var elmtTable2 = document.getElementById('tweet_table');
    for (var i = 1; i < elmtTable2.rows.length; i++)
    {
         elmtTable2.deleteRow(i);
    }
    
    //Get input of the checkboxes
    arguments0 = {
    input: $("#inputForm input[name='searchBox']").val(),    
    geotagged: $('#inlineCheckbox_geotagged:checked').val(),
    profile: $('#inlineCheckbox_profile:checked').val(),
    geoword: $('#inlineCheckbox_geoword:checked').val(),
    networking: $('#inlineCheckbox_networking:checked').val(),
    facebook: $('#inlineCheckbox_facebook:checked').val(),
    twitter: $('#inlineCheckbox_twitter:checked').val()
    };
    
    //Get inputs of checkboxes for show_tweets.php
    arguments1 = {
        input: $("#inputForm input[name='searchBox']").val(),    
        geotagged: $('#inlineCheckbox_geotagged:checked').val(),
        profile: $('#inlineCheckbox_profile:checked').val(),
        geoword: $('#inlineCheckbox_geoword:checked').val(),
        networking: $('#inlineCheckbox_networking:checked').val()
    };
    
    //Pass input into search_inputs.php and hence load the result in tab_content_3 (inputs tab)
    $.ajax({
        type: "POST",
        url: "search_inputs.php",
        data: {arguments: arguments0},
        success: function(data) {
          $("#tab_content_3").html(data);   

        }
    });
    
    //Pass input into search_outputs.php and hence load the result in tab_content_4 (outputs tab)
    $.ajax({
        type: "POST",
        url: "search_outputs.php",
        data: {arguments: arguments0},
        success: function(data) {
          $("#tab_content_4").html(data);   

        }
    });
    
    //Show loading animation
    $('.animation_image').show(); 
    
    //Pass input into fetch_page.php and hence load the result in dataBody (results tab)
    $.ajax({
        type: "POST",
        url: "fetch_page.php",
        data: {arguments: arguments0},
        success: function(data) {
          $(".dataBody").html(data);   
          $('.animation_image').hide(); 
        }
    });
    
    //Pass input into show_tweets.php but only when twitter checkbox is checked
    //and show results in tweet_table_body (tweets tab)
    if($('#inlineCheckbox_twitter:checked').val()==="twitter"){
        $('.animation_image_2').show();  
        $('#resulting_tweets').show();
        $.ajax({
            type: "POST",
            url: "show_tweets.php",
            data: {arguments: arguments1},
            success: function(data) {   
                $(".tweet_table_body").html(data);   
                $('.animation_image_2').hide(); 

            }
        });
    }
    

    return false;

}  

//Control the timing. Load_reuslts_1 takes input from prototypePage.php and create table
//codeAddress pulls the data out of the table and store into array with is used for Google heat map
//heatmap.setMap() then reload the map
function load_results(){
    load_results_1();
    setTimeout(function(){
        codeAddress();
    }, 10000);
    setTimeout(function(){
        heatmap.setMap(map);
    }, 10000);
}
