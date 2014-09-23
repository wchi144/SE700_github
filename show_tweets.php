<!--Show Tweets-->
<!--Fetch tweets from database and display in tweet tab of Results Tabs section in prototypePage.php-->
<!--By Shiyi Zhang and Wei-Ling Chin-->
<?php
include("config.php"); 

// Initialize the variables
$input = "";
$query = "";
$geotagged = False;
$profile = False;
$geoword = False;
$networking = False;

// Check for user input from prototypePage.php
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
        } else {
            $input = $value;       
        }  
    }
} else {   
	// Print out an error message if not user input is given after clicking the search button
    echo "Error: Cannot get input";
}

// Check for valid input
if(empty($input)){
    exit("Error: Please input a search word");  
}

// Use pattern-matching to select tweets that contain the user input keyword
$try_query = "SELECT * FROM `post_twitter` where tweet_text LIKE '%".$input."%'";

$results = mysqli_query($connecDB, $try_query);

// Output the actual tweet results from database
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