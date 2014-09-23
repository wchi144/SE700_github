<!--Fetch Page-->
<!--Fetch results for both Twitter and Facebook from database depending on the user input-->
<!--By Shiyi Zhang and Wei-Ling Chin-->
<?php
include("config.php"); 

// Initialize the variables
$input = "";
$geotagged = False;
$profile = False;
$geoword = False;
$networking = False;
$facebook = False;
$twitter = False;

// Check if we have user input from prototypePage.php
if (isset($_POST['arguments'])) {

	// Check if each checkbox is ticked or not
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
	// Print out an error message if not user input is given after clicking the search button
    echo "Error: Cannot get input";
}

// Initialize the query for each checkbox
$query_geotagged_fb = "";
$query_profile_fb = "";
$query_geoword_fb = "";
$query_networking_fb = "";
$query_geotagged_twitter = "";
$query_profile_twitter = "";
$query_geoword_twitter = "";
$query_networking_twitter = "";
$final_query = "";

// Check for valid input
if(empty($input)){
    exit("Error: Please input a search word");  
}

// Get twitter results
if($twitter){
    $twitter_query = "SELECT user_id FROM `post_twitter` where tweet_text LIKE '%".$input."%'";

    $results = mysqli_query($connecDB, $twitter_query);

    // Output results from database
    echo '<table class="result">';
    while($row = mysqli_fetch_array($results))
    {
            $user_id = $row['user_id'];
            $city = "None";

			// Get the user location information using the geo-tagged method, the result will be assigned into the $city variable
            if($geotagged){
			
				// Query data from the api_twitter table which uses the geo-tagged method
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

			// If no location information can be found, use the user profile method to locate this user
            if($city == "None" && $profile){
			
				// Query data from the profile_twitter table which uses the user profile method
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
 
			// If no location information can be found, use the social network method to locate this user
            if($city == "None" && $networking){
			
				// Query data from the networking table which uses the social network method
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
            
			// If no location information can be found, use the geo-word table to locate the user
            if($city == "None" && $geoword){
			
				// Query data from the geoword table which uses the geo-word method
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

			// If no location information can be found using the four geolocation methods, the user is considered as unlocatable
            if($city=="None" || empty($city)){
                continue;
            }

			// Display the locations of the users onto a table
            echo '<tr>';
            echo '<td>' . $country . '</td><td>' . $city . '</td><td>' . $lat.', '.$long . '</td><td>' . $cnt . '</td>';
            echo '</tr>';
    }
    echo '</table>';
}

// Get Facebook results if the Facebook checkbox is ticked
if($facebook){
    // Get the user profile location from the profile_fb table according to the user input
	// E.g., to get the locations of users that have mentioned Katy Perry on Facebook: SELECT user_id FROM profile_fb WHERE artist LIKE "%katyperry%"
    $fb_query = "SELECT user_id "
            . "FROM profile_fb "
            . "WHERE artist LIKE '%".$input."%'";

    $result_fb = mysqli_query($connecDB, $fb_query);

	// Display the result into the result table
    echo '<table class="result">';
	
	// For each row, store the location information into the $city variable
    while($row_fb = mysqli_fetch_array($result_fb))
    {
            $user_id = $row_fb['user_id'];
            $city = "None";

			// If the profile checkbox is selected, use the user profile method to locate a user
            if($profile){
				
				// Query data from the profile_fb table which uses the user profile method
                $query = "SELECT profile_fb.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long "
                        . "FROM profile_fb "
                        . "JOIN locations ON profile_fb.location_id = locations.location_id "
                        . "WHERE profile_fb.`user_id` =".$user_id;
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

			// If no location information can be found, use the social network method to locate this user
            if($city == "None" && $networking){
			
				// Query data from the networking_fb table which uses the social network method
                $query = "SELECT networking_fb.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long "
                        . "FROM networking_fb "
                        . "JOIN locations ON networking_fb.location_id = locations.location_id "
                        . "WHERE networking_fb.`user_id` =".$user_id;
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
            
			// If not location information can be found using the two geolocation methods for Facebook, the user is then considered as unlocatable
            if($city=="None" || empty($city)){
                continue;
            }

			// Display the results into the table
            echo '<tr>';
            echo '<td>' . $country . '</td><td>' . $city . '</td><td>' . $lat.', '.$long . '</td><td>' . $cnt . '</td>';
            echo '</tr>';
    }        
    echo '</table>';
}


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