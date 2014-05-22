<?php
include("config.php");

//Get the results from the query
$results = mysqli_query($connecDB,"SELECT COUNT(*) FROM result");

//Get an array of the records
$get_total_rows = mysqli_fetch_array($results); 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"></meta>
		<meta content="IE=edge" http-equiv="X-UA-Compatible"></meta>
		<meta content="width=device-width, initial-scale=1" name="viewport"></meta>
		<meta content="" name="description"></meta>
		<meta content="" name="author"></meta>
		<link href="../../assets/ico/favicon.ico" rel="shortcut icon"></link>
		<title></title>
		<link rel="stylesheet" href="css/bootstrap.min.css"></link>
		<link rel="stylesheet" href="css/myCSS.css"></link>
		
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization"></script>
		<script src="js/googleMap.js"></script>
		
	</head>
	<body>
		<?php include("header.php") ?>
		
		<div class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header"></div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="home.php">Home</a>
						</li>
						<li class="active">
							<a href="prototypePage.php">Prototype</a>
						</li>
					</ul>
				</div>
			</div>
		</div>		
		<div class="container">
			<p>
				Enter an artist name in the search box and see their popularity distribution on the heatmap below
			</p>
			<br>
			<div class="row">
				<div class="col-md-11">
					<input type="text" class="form-control" id="searchBox" placeholder="Text input">
				</div>
				<div class="col-md-1">
					<button type="button" class="btn btn-primary" id="searchButton">Search</button>
					
				</div>
			</div>
			<br>
			<div class="row">
				<!--  HEATMAP SECTION -->
				<div class="col-md-8">
					<div id="map_canvas"></div>
				</div>	
				<!--  TABLE SECTION -->
				<div class="col-md-4">
					<table class="table table-striped">
						<thead>
							<tr>
								<th style="width:105px">
									Country
								</th>
								<th style="width:105px">
									City
								</th>
								<th style="width:105px">
									People Count
								</th>
							</tr>
						</thead>
						<tbody class="dataBody">
							<div class="animation_image" style="display:none; aligh:center; margin-top:150px; margin-left:50px"><img src="images/ajax-loader.gif"> Loading...</div>
						</tbody>
					</table>
				</div>
			</div>

			<hr></hr>
			<?php include("footer.php") ?>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
		
			//Get the number of rows of the resulting query
			var total_rows = <?php echo $get_total_rows[0]; ?>;
		
			//When the search button is clicked
			$("#searchButton").click(function (e) { 
	
				//Show loading image
				$('.animation_image').show(); 

				//post page number and load returned data into result element
				$.post('fetch_page.php', function(data) {
		
					$('.dataBody').load("fetch_page.php");
					
					//Hide loading image
					$('.animation_image').hide(); //hide loading image once data is received
	
				});
			});
		});
</script>
	</body>
</html>