<?php
include("config.php"); 

//$input = "start";

//if (isset($_POST["searchBox"])) 
//{
//  $input = $_POST["searchBox"];
//  echo "input: $input";
//} 
//else 
//{
//    //no inout because search button must be of type submit but then only this php is loaded
//  $input = null;
//  echo "no input supplied";
//}


// Check if we have user input from prototypePage.php
if (isset($_POST['arguments'])) {

    $input = $_POST['arguments'];
    //echo "Searched: $input";
} else {
    
    echo "can't get input";
}

//foreach($_POST['arguments'] as $v) echo $v;




//$results = mysqli_query($connecDB,"SELECT * FROM test_api ORDER BY user_id");
//SELECT api_twitter.* FROM api_twitter INNER JOIN post_twitter ON api_twitter.user_id=post_twitter.user_id WHERE post_twitter.tweet_text LIKE '%news%' limit 13
//$results = mysqli_query($connecDB,"SELECT * FROM `api_twitter` limit 500");
//SELECT api_twitter.*, post_twitter.*, COUNT(*) as PeopleCount FROM api_twitter INNER JOIN post_twitter ON api_twitter.user_id=post_twitter.user_id WHERE post_twitter.tweet_text LIKE '%news%' GROUP BY api_twitter.city, api_twitter.country
$results = mysqli_query($connecDB,"SELECT api_twitter.*, post_twitter.*, COUNT(*) as PeopleCount FROM api_twitter INNER JOIN post_twitter ON api_twitter.user_id=post_twitter.user_id WHERE post_twitter.tweet_text LIKE '%".$input."%' AND city!='None' GROUP BY api_twitter.city, api_twitter.country");

//Output results from database
echo '<table class="result">';
while($row = mysqli_fetch_array($results))
{
	$user_id = $row['user_id'];       
	$lat = $row['geo_lat'];
	$long = $row['geo_long'];        
	$city = $row['city'];
	$country = $row['country'];
        $cnt = $row['PeopleCount'];
        
        if($city=="None" || $country=="None"){
            $address = geolonglat($lat, $long);
            $city = $address[0];
            $country = $address[1]; 
            //Add city and country to database
            mysqli_query($connecDB,"UPDATE api_twitter SET city = '".$city."' WHERE user_id = ".$user_id);
            mysqli_query($connecDB,"UPDATE api_twitter SET country = '".$country."' WHERE user_id = ".$user_id);
            
        }

	//$count = 1;
	//$string_count = "$count";
	
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
