<?php
include("config.php"); 

$input = "";
$query = "";
$geotagged = False;
$profile = False;
$geoword = False;
$networking = False;

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
        } else {
            $input = $value;       
        }  
    }
} else {   
    echo "Error: Cannot get input";
}

//Check for valid input
if(empty($input)){
    exit("Error: Please input a search word");  
}

//in decending order or accuracy
if($networking){
    //SELECT networking.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount FROM networking JOIN post_twitter ON post_twitter.user_id = networking.user_id JOIN locations ON locations.location_id = networking.location_id WHERE post_twitter.tweet_text LIKE '%one direction%' AND locations.city!='None' GROUP BY locations.city, locations.country
    $query = "SELECT networking.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount "
            . "FROM networking JOIN post_twitter ON post_twitter.user_id = networking.user_id "
            . "JOIN locations ON locations.location_id = networking.location_id "
            . "WHERE post_twitter.tweet_text LIKE '%".$input."%' "
            . "AND locations.city!='None' "
            . "GROUP BY locations.city, locations.country";
}     
if ($geoword){
    //SELECT geoword.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount FROM geoword JOIN post_twitter ON post_twitter.user_id = geoword.user_id JOIN locations ON locations.location_id = geoword.location_id WHERE post_twitter.tweet_text LIKE '%one direction%' AND locations.city!='None' GROUP BY locations.city, locations.country
    $query = "SELECT geoword.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount "
            . "FROM geoword JOIN post_twitter ON post_twitter.user_id = geoword.user_id "
            . "JOIN locations ON locations.location_id = geoword.location_id "
            . "WHERE post_twitter.tweet_text LIKE '%".$input."%' "
            . "AND locations.city!='None' "
            . "GROUP BY locations.city, locations.country";
}   
if ($profile){
    //$query_profile_twitter
    $query ="SELECT profile_twitter.user_id, post_twitter.tweet_text, locations.city, locations.country, locations.geo_lat, locations.geo_long, COUNT(*) as PeopleCount "
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
    $query = "SELECT api_twitter.*, post_twitter.tweet_text, COUNT(*) as PeopleCount "
            . "FROM api_twitter "
            . "INNER JOIN post_twitter "
            . "ON api_twitter.user_id=post_twitter.user_id "
            . "WHERE post_twitter.tweet_text LIKE '%".$input."%' AND city!='None'"
            . "GROUP BY api_twitter.city, api_twitter.country";
}

//check that final_query is not empty. Which means user did not choose a result type
if($query==""){
    exit("<strong>Error</strong>: Exit due to empty query. Select a result type from result filter");  
}

$results = mysqli_query($connecDB, $query);

//Output results from database
echo '<table class="results_tweets">';
while($row = mysqli_fetch_array($results))
{
	$user_id = $row['user_id'];       
	$tweet_text = $row['tweet_text'];

	
	echo '<tr>';
	echo '<td>' . $user_id . '</td><td>' . $tweet_text .'</td>';
	echo '</tr>';
}
echo '</table>';