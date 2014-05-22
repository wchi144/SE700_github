<?php
include("config.php"); 

$results = mysqli_query($connecDB,"SELECT * FROM result ORDER BY id");

//Output results from database
echo '<table class="result">';
while($row = mysqli_fetch_array($results))
{
	echo '<tr>';
	echo '<td>' . $row['city'] . '</td><td>' . $row['country'] . '</td><td>' . $row['count'] . '</td>';
	echo '</tr>';
}
echo '</table>';
?>

