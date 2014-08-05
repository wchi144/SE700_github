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
    if($geotagged){
        $query_geotagged_twitter = "SELECT api_twitter.*, post_twitter.tweet_text, COUNT(*) as PeopleCount "
                . "FROM api_twitter "
                . "INNER JOIN post_twitter "
                . "ON api_twitter.user_id=post_twitter.user_id "
                . "WHERE post_twitter.tweet_text LIKE '%".$input."%' AND city!='None'"
                . "GROUP BY api_twitter.city, api_twitter.country";
    } elseif ($profile){
        //$query_profile_twitter =;
    } elseif ($geoword){
        //$query_geoword_twitter =;
    }elseif ($networking){
        //$query_networking_twitter =;
    } else {
        //WRONG SHOULDN"T BE HERE
    } 
}else {
    //WRONG SHOULDN"T BE HERE
}

$query_array = array($query_geotagged_fb, $query_profile_fb, $query_geoword_fb, 
    $query_networking_fb, $query_geotagged_twitter, $query_profile_twitter, 
    $query_profile_twitter, $query_geoword_twitter);

$join = "UNION ALL";
$final_query = "";

foreach($query_array as $query){
    if ($query==""){
        continue;
    } else {
        if($final_query==""){
            $final_query = $query;
        } else {
            $final_query = $final_query.$join.$query;
        }
        
    } 

}

echo "<strong>Query</strong>: $final_query<br>";