<!--Search Outputs-->
<!--Display output statistics in outputs tab of Results Tabs section in prototypePage.php-->
<!--(Test and Checking Purposes)-->
<!--by Shiyi Zhang and Wei-Ling Chin-->
<?php
include("config.php"); 

$input = "";
$geotagged = False;
$profile = False;
$geoword = False;
$networking = False;
$facebook = False;
$twitter = False;

$fb_total_cnt = 0;
$fb_profile_cnt = 0;
$fb_network_cnt = 0;

$tw_total_cnt = 0;
$tw_profile_cnt = 0;
$tw_network_cnt = 0;
$tw_geotagged_cnt = 0;
$tw_geoword_cnt = 0;

// Check for user input from prototypePage.php
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
    echo "Error: can't get input<br>";
}

$query_geotagged_fb = "";
$query_profile_fb = "";
$query_geoword_fb = "";
$query_networking_fb = "";
$query_geotagged_twitter = "";
$query_profile_twitter = "";
$query_geoword_twitter = "";
$query_networking_twitter = "";

//Results for facebook
if($facebook){
    //SELECT user_id FROM profile_fb WHERE artist LIKE "%katyperry%"
    $fb_query = "SELECT user_id "
            . "FROM profile_fb "
            . "WHERE artist LIKE '%".$input."%'";

    $result_fb = mysqli_query($connecDB, $fb_query);
    $fb_total_cnt = mysqli_num_rows($result_fb);

    echo '<table class="result">';
    while($row_fb = mysqli_fetch_array($result_fb))
    {
        $user_id = $row_fb['user_id'];
        $city = "None";
        //echo $user_id;

        if($profile){
            $query = "SELECT profile_fb.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long "
                    . "FROM profile_fb "
                    . "JOIN locations ON profile_fb.location_id = locations.location_id "
                    . "WHERE profile_fb.`user_id` =".$user_id;


            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){     
                    $city = $row_inner['city'];
                    if($city!="None" || !empty($city)){
                        $fb_profile_cnt = $fb_profile_cnt + 1; 
                    }
                }                
            }

        }



        if($networking){
            $query = "SELECT networking_fb.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long "
                    . "FROM networking_fb "
                    . "JOIN locations ON networking_fb.location_id = locations.location_id "
                    . "WHERE networking_fb.`user_id` =".$user_id;
            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){     
                    $city = $row_inner['city'];
                    if($city!="None" || !empty($city)){
                        $fb_network_cnt = $fb_network_cnt + 1; 
                    }
                } 
            }
        }

    }        

}

//Results for twitter
if ($twitter){
$try_query = "SELECT user_id FROM `post_twitter` where tweet_text LIKE '%".$input."%'";

$results = mysqli_query($connecDB, $try_query);
$tw_total_cnt = mysqli_num_rows($results);

while($row = mysqli_fetch_array($results))
{
    $user_id = $row['user_id'];
    $city = "None";


    if($geotagged){
        $query = "SELECT * FROM api_twitter WHERE user_id=".$user_id;
        $outputs = mysqli_query($connecDB, $query);
        if(mysqli_num_rows($outputs) != 0){
            while($row_inner = mysqli_fetch_array($outputs)){    
                $city = $row_inner['city'];
                if($city!="None" || !empty($city)){
                    $tw_geotagged_cnt = $tw_geotagged_cnt + 1; 
                }

            }                
        }

    }


    if($profile){
        $query = "SELECT profile_twitter.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long FROM profile_twitter JOIN locations ON profile_twitter.location_id = locations.location_id WHERE profile_twitter.`user_id` =".$user_id;
        $outputs = mysqli_query($connecDB, $query);
        if(mysqli_num_rows($outputs) != 0){
            while($row_inner = mysqli_fetch_array($outputs)){      
                $city = $row_inner['city'];
                if($city!="None" || !empty($city)){
                    $tw_profile_cnt = $tw_profile_cnt + 1; 
                }

            } 
        }
    }

    if($networking){
        $query = "SELECT networking.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long FROM networking JOIN locations ON networking.location_id = locations.location_id WHERE networking.`user_id` =".$user_id;
        $outputs = mysqli_query($connecDB, $query);
        if(mysqli_num_rows($outputs) != 0){
            while($row_inner = mysqli_fetch_array($outputs)){      
                $city = $row_inner['city'];
                if($city!="None" || !empty($city)){
                    $tw_network_cnt = $tw_network_cnt + 1; 
                } 
            } 
        }
    }

    if($geoword){
        $query = "SELECT geoword.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long FROM geoword JOIN locations ON geoword.location_id = locations.location_id WHERE geoword.`user_id` =".$user_id;
        $outputs = mysqli_query($connecDB, $query);
        if(mysqli_num_rows($outputs) != 0){
            while($row_inner = mysqli_fetch_array($outputs)){     
                $city = $row_inner['city'];
                if($city!="None" || !empty($city)){
                    $tw_geoword_cnt = $tw_geoword_cnt + 1; 
                }

            }     
        }
    }



        
}
}else {
    //SHOULDN"T BE HERE
}

//Echo statsitcs of results
echo "<strong>Facebook Result Count</strong>: $fb_total_cnt<br>";
echo "<strong>Profile Result Count</strong>: $fb_profile_cnt<br>";
echo "<strong>Networking Result Count</strong>: $fb_network_cnt<br>";

echo "<br>";

echo "<strong>Twitter Result Count</strong>: $tw_total_cnt<br>";
echo "<strong>GeoTagged Result Count</strong>: $tw_geotagged_cnt<br>";
echo "<strong>Profile Result Count</strong>: $tw_profile_cnt<br>";
echo "<strong>GeoWord Result Count</strong>: $tw_geoword_cnt<br>";
echo "<strong>Networking Result Count</strong>: $tw_network_cnt<br>";

