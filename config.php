<!--Configuration Page-->
<!--Configuration MySQL database-->
<!--By Shiyi Zhang and Wei-Ling Chin-->
<?php
/*Configure the properties of a database*/

$db_username = 'root';
$db_password = 'admin';
$db_name = 'se700_twitter';
$db_host = 'localhost';

//Connect to the database using the user name and password set previously.
$connecDB = mysqli_connect($db_host, $db_username, $db_password,$db_name)

//Error message for not being able to connect to the database.
or die('could not connect to database');
?>