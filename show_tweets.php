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

$try_query = "SELECT * FROM `post_twitter` where tweet_text LIKE '%".$input."%'";

$results = mysqli_query($connecDB, $try_query);

//Output results from database
echo '<table class="result">';
while($row = mysqli_fetch_array($results))
{
	$user_id = $row['user_id'];
        $tweet_text = $row['tweet_text'];

	echo '<tr>';
	echo '<td>' . $user_id . '</td><td>' . $tweet_text .'</td>';
	echo '</tr>';
}
echo '</table>';

