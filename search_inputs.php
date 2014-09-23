<!--Search Inputs-->
<!--Display input variables in inputs tab of Results Tabs section in prototypePage.php-->
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
    echo "<strong>Searched for:</strong> $input<br>";
    echo "<strong>Selected:</strong><br>";
    if($geotagged){
        echo "Geotagged<br>";
    }
    if($profile){
        echo "Profile<br>";
    }
    if($geoword){
        echo "Geoword<br>";
    }
    if($networking){
        echo "Networking<br>";
    }
    if($facebook){
        echo "Facebook<br>";
    }
    if($twitter){
        echo "Twitter<br>";
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

echo "<strong>Queries</strong>:<br>";


if($facebook){
    //results for facebook
    //SELECT user_id FROM profile_fb WHERE artist LIKE "%katyperry%"
    $fb_query = "SELECT user_id "
            . "FROM profile_fb "
            . "WHERE artist LIKE '%".$input."%'";

    $result_fb = mysqli_query($connecDB, $fb_query);

    while($row_fb = mysqli_fetch_array($result_fb))
    {
            $user_id = $row_fb['user_id'];
            $city = "None";

            if($profile){
                $query = "SELECT profile_fb.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long "
                        . "FROM profile_fb "
                        . "JOIN locations ON profile_fb.location_id = locations.location_id "
                        . "WHERE profile_fb.`user_id` =".$user_id;
                echo "<br>$query<br>";
                $outputs = mysqli_query($connecDB, $query);
                if(mysqli_num_rows($outputs) != 0){
                    while($row_inner = mysqli_fetch_array($outputs)){      
                        $city = $row_inner['city'];
                    }                
                }

            }

            if($city == "None" && $networking){
                $query = "SELECT networking_fb.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long "
                        . "FROM networking_fb "
                        . "JOIN locations ON networking_fb.location_id = locations.location_id "
                        . "WHERE networking_fb.`user_id` =".$user_id;
                echo "<br>$query<br>";
                $outputs = mysqli_query($connecDB, $query);
                if(mysqli_num_rows($outputs) != 0){
                    while($row_inner = mysqli_fetch_array($outputs)){      
                        $city = $row_inner['city'];
                    } 
                }
            }
            
            if($city=="None" || empty($city)){
                continue;
            }

    }        

} else if ($twitter){
    //results for twitter
$try_query = "SELECT user_id FROM `post_twitter` where tweet_text LIKE '%".$input."%'";
echo "$try_query<br>";
$results = mysqli_query($connecDB, $try_query);

while($row = mysqli_fetch_array($results))
{
	$user_id = $row['user_id'];
        $city = "None";

        if($geotagged){
            $query = "SELECT * FROM api_twitter WHERE user_id=".$user_id;
            echo "<br>$query<br>";
            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){    
                    $city = $row_inner['city'];
                }                
            }

        }
        
        if($city == "None" && $profile){
            $query = "SELECT profile_twitter.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long FROM profile_twitter JOIN locations ON profile_twitter.location_id = locations.location_id WHERE profile_twitter.`user_id` =".$user_id;
            echo "<br>$query<br>";
            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){      
                    $city = $row_inner['city'];
                } 
            }
        }

        if($city == "None" && $networking){
            $query = "SELECT networking.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long FROM networking JOIN locations ON networking.location_id = locations.location_id WHERE networking.`user_id` =".$user_id;
            echo "<br>$query<br>";
            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){      
                    $city = $row_inner['city'];

                } 
            }
        }        
 
        if($city == "None" && $geoword){
            $query = "SELECT geoword.location_id, locations.city, locations.country, locations.geo_lat, locations.geo_long FROM geoword JOIN locations ON geoword.location_id = locations.location_id WHERE geoword.`user_id` =".$user_id;
            echo "<br>$query<br>";
            $outputs = mysqli_query($connecDB, $query);
            if(mysqli_num_rows($outputs) != 0){
                while($row_inner = mysqli_fetch_array($outputs)){     
                    $city = $row_inner['city'];
                }     
            }
        }

        
        if($city=="None" || empty($city)){
            continue;
        }
}
}else {
    //SHOULDN"T BE HERE
}


