<!--Configuration Page-->
<!--Configuration MySQL database-->
<!--by Shiyi Zhang and Wei-Ling Chin-->
<?php
$db_username = 'root';
$db_password = 'admin';
$db_name = 'se700_twitter';
$db_host = 'localhost';

$connecDB = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
?>