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
} else if ($twitter){
    //in decending order or accuracy
    if($networking){
        //SELECT networking.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount FROM networking JOIN post_twitter ON post_twitter.user_id = networking.user_id JOIN locations ON locations.location_id = networking.location_id WHERE post_twitter.tweet_text LIKE '%one direction%' AND locations.city!='None' GROUP BY locations.city, locations.country
        $final_query = "SELECT networking.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount "
                . "FROM networking "
                . "JOIN post_twitter ON post_twitter.user_id = networking.user_id "
                . "JOIN locations ON locations.location_id = networking.location_id "
                . "WHERE post_twitter.tweet_text LIKE '%".$input."%' "
                . "AND locations.city!='None' "
                . "GROUP BY locations.city, locations.country";
    }     
    if ($geoword){
        //SELECT geoword.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount FROM geoword JOIN post_twitter ON post_twitter.user_id = geoword.user_id JOIN locations ON locations.location_id = geoword.location_id WHERE post_twitter.tweet_text LIKE '%one direction%' AND locations.city!='None' GROUP BY locations.city, locations.country
        $final_query = "SELECT geoword.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount "
                . "FROM geoword "
                . "JOIN post_twitter ON post_twitter.user_id = geoword.user_id "
                . "JOIN locations ON locations.location_id = geoword.location_id "
                . "WHERE post_twitter.tweet_text LIKE '%".$input."%' "
                . "AND locations.city!='None' "
                . "GROUP BY locations.city, locations.country";
    }   
    if ($profile){
        //$query_profile_twitter
        //SELECT profile_twitter.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount FROM profile_twitter JOIN post_twitter ON post_twitter.user_id = profile_twitter.user_id JOIN locations ON locations.location_id = profile_twitter.location_id WHERE post_twitter.tweet_text LIKE '%".$input."%' AND locations.city!='None' GROUP BY locations.city, locations.country
        $final_query ="SELECT profile_twitter.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount "
                . "FROM profile_twitter "
                . "JOIN post_twitter "
                . "ON post_twitter.user_id = profile_twitter.user_id "
                . "JOIN locations "
                . "ON locations.location_id = profile_twitter.location_id "
                . "WHERE post_twitter.tweet_text LIKE '%".$input."%' AND locations.city!='None' "
                . "GROUP BY locations.city, locations.country";
    }    
    if($geotagged){
        //$query_geotagged_twitter
        $final_query = "SELECT api_twitter.*, post_twitter.tweet_text, COUNT(*) as PeopleCount "
                . "FROM api_twitter "
                . "INNER JOIN post_twitter "
                . "ON api_twitter.user_id=post_twitter.user_id "
                . "WHERE post_twitter.tweet_text LIKE '%".$input."%' AND city!='None'"
                . "GROUP BY api_twitter.city, api_twitter.country";

        
        //Get city and country on demand
//        $final_query = "SELECT api_twitter.*, post_twitter.tweet_text "
//                . "FROM api_twitter "
//                . "INNER JOIN post_twitter "
//                . "ON api_twitter.user_id=post_twitter.user_id "
//                . "WHERE post_twitter.tweet_text LIKE '%".$input."%'";
    } 

}else {
    exit("Exit due to empty query. Select a SNS from result filter");  
}

//check that final_query is not empty. Which means user did not choose a result type
if($final_query==""){
    exit("Exit due to empty query. Select a result type from result filter");  
}

$results = mysqli_query($connecDB, $final_query);

//Output results from database
echo '<table class="result">';
while($row = mysqli_fetch_array($results))
{
	
    
	$lat = $row['geo_lat'];
	$long = $row['geo_long'];        
	$city = $row['city'];
	$country = $row['country'];
        $cnt = $row['PeopleCount'];
        //$cnt = "1";
        
        if($city=="None" && $country=="None"){
            $address = geolonglat($lat, $long);
            $city = $address[0];
            $country = $address[1]; 
            //Add city and country to database
            mysqli_query($connecDB,"UPDATE api_twitter SET city = '".$city."' WHERE user_id = ".$user_id);
            mysqli_query($connecDB,"UPDATE api_twitter SET country = '".$country."' WHERE user_id = ".$user_id);        
        }
	
	echo '<tr>';
	echo '<td>' . $country . '</td><td>' . $city . '</td><td>' . $lat.', '.$long . '</td><td>' . $cnt . '</td>';
	echo '</tr>';
}
echo '</table>';

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


