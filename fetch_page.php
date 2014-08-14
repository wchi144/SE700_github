<?php
include("config.php"); 

$input = "";
$geotagged = False;
$profile = False;
$geoword = False;
$networking = False;
$facebook = False;
$twitter = False;

// Check if we have user input from prototypePage.php
if (isset($_POST['arguments'])) {

    foreach($_POST['arguments'] as $key => $value){ 
        if($value=="geotagged") {
            $geotagged = True;
        }    
        elseif ($value=="profile") {
            $profile = True;
        }   
        elseif($value=="geoword") {
            $geoword = True;
        }
        elseif($value=="networking") {
            $networking = True;
        } 
        elseif($value=="facebook") {
            $facebook = True;
        }
        elseif($value=="twitter") {
            $twitter = True;
        } else {
            $input = $value;  
        }  
    }
} else {   
    echo "Error: Cannot get input";
}

$query_geotagged_fb = "";
$query_profile_fb = "";
$query_geoword_fb = "";
$query_networking_fb = "";
$query_geotagged_twitter = "";
$query_profile_twitter = "";
$query_geoword_twitter = "";
$query_networking_twitter = "";
$final_query = "";

//Check for valid input
if(empty($input)){
    exit("Error: Please input a search word");  
}

//Query building section
if($facebook){
    if($geotagged){
        $query_geotagged_fb = "";
    } elseif ($profile){
        //$query_profile_fb =;
    } elseif ($geoword){
        //$query_geoword_fb =;
    }elseif ($networking){
        //$query_networking_fb =;
    } else {
        //WRONG SHOULDN"T BE HERE
    }
} 
//check that final_query is not empty. Which means user did not choose a result type. NOT NEEDED FOR TWITTER
//if($final_query==""){
    //exit("Exit due to empty query. Select a result type from result filter");  
//}

$twitter_query = "SELECT user_id FROM `post_twitter` where tweet_text LIKE '%".$input."%'";

$results = mysqli_query($connecDB, $twitter_query);

//Output results from database
echo '<table class="result">';
while($row = mysqli_fetch_array($results))
{
	$user_id = $row['user_id'];
        $city = "None";
        //echo $user_id;

        if($geotagged){
            $query = "SELECT * FROM api_twitter WHERE user_id=".$user_id;
            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){
                    $lat = $row_inner['geo_lat'];
                    $long = $row_inner['geo_long'];        
                    $city = $row_inner['city'];
                    $country = $row_inner['country'];
                    $cnt = "1";
                }                
            }

        }
        
        if($city == "None" && $profile){
            $query = "SELECT profile_twitter.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long FROM profile_twitter JOIN locations ON profile_twitter.location_id = locations.location_id WHERE profile_twitter.`user_id` =".$user_id;
            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){
                    $lat = $row_inner['geo_lat'];
                    $long = $row_inner['geo_long'];        
                    $city = $row_inner['city'];
                    $country = $row_inner['country'];
                    $cnt = "1";
                } 
            }
        }
 
        if($city == "None" && $geoword){
            $query = "SELECT geoword.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long FROM geoword JOIN locations ON geoword.location_id = locations.location_id WHERE geoword.`user_id` =".$user_id;
            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){
                    $lat = $row_inner['geo_lat'];
                    $long = $row_inner['geo_long'];        
                    $city = $row_inner['city'];
                    $country = $row_inner['country'];
                    $cnt = "1";
                }     
            }
        }

        if($city == "None" && $networking){
            $query = "SELECT networking.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long FROM networking JOIN locations ON networking.location_id = locations.location_id WHERE networking.`user_id` =".$user_id;
            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){
                    $lat = $row_inner['geo_lat'];
                    $long = $row_inner['geo_long'];        
                    $city = $row_inner['city'];
                    $country = $row_inner['country'];
                    $cnt = "1";
                } 
            }
        }
        
        if($city=="None" || empty($city)){
            continue;
        }
        
	echo '<tr>';
	echo '<td>' . $country . '</td><td>' . $city . '</td><td>' . $lat.', '.$long . '</td><td>' . $cnt . '</td>';
	echo '</tr>';
}
echo '</table>';

//Function to get city and country name using long and lat. Limit of 2500 per day.
function geolonglat($lat, $long){
    $attemps = 0;
    $success = False;
    
    while (!$success && $attemps <3){
        $attemps = $attemps + 1;
        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=true";
        $data = file_get_contents($url);
        $jsondata = json_decode($data,true);
        
        if( is_array($jsondata) && $jsondata['status'] == "OK"){
            // city
            foreach ($jsondata["results"] as $result) {
                    foreach ($result["address_components"] as $address) {
                            if (in_array("locality", $address["types"])) {
                                    $city = $address["long_name"];
                            }
                    }
            }
            // country
            foreach ($jsondata["results"] as $result) {
                    foreach ($result["address_components"] as $address) {
                            if (in_array("country", $address["types"])) {
                                    $country = $address["long_name"];
                            }
                    }
            }
            $success = True;
            return array($city, $country);  
        } 
        
        if( is_array($jsondata) && $jsondata['status'] == "OVER_QUERY_LIMIT"){
            sleep(5);
        }
      
    }

    if($attemps == 3){
        print "excessed reques to google map service limit";
        
    }
}


