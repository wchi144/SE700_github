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
		<!--  NAVIGATION SECTION -->
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
			<h2>
				Search
			</h2>
			<p>
				Enter an artist name in the search box and see their popularity distribution on the heatmap below
			</p>
			<div class="row">
				<div class="col-md-11">
					<input type="text" class="form-control" id="searchBox" placeholder="Text input">
				</div>
				<div class="col-md-1">
					<button type="button" class="btn btn-primary" id="searchButton" onclick = "load_results()">Search</button>	
				</div>
			</div>
			<br>
			
			<!--  SUB RESULTS CHECKBOX SECTION -->
			<div class="panel-group" id="accordion">
			  <div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					  Filter Results
					</a>
				  </h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse">
					<div class="panel-body">
						<strong> Filter by result types </strong>
						<div class="make-switch switch-mini" id="selectAll_1">
							<input type="checkbox" id="rowSelectAllc">
						</div>
						<div class="row">
							<div class="col-lg-6 toggle-state-switch1">
								<input type="checkbox" id="inlineCheckbox_geotagged" value="option1"> geotagged
							</div><!-- /.col-lg-6 -->
							<div class="col-lg-6 toggle-state-switch1">
								<input type="checkbox" id="inlineCheckbox_user" value="option2"> user profile
							</div><!-- /.col-lg-6 -->
						</div><!-- /.row -->
						<div class="row">
							<div class="col-lg-6 toggle-state-switch1">
								<input type="checkbox" id="inlineCheckbox_geo-words" value="option1"> geo-words
							</div><!-- /.col-lg-6 -->
							<div class="col-lg-6 toggle-state-switch1">
								<input type="checkbox" id="inlineCheckbox_networking" value="option2"> networking
							</div><!-- /.col-lg-6 -->
						</div><!-- /.row -->
						<hr>
						<strong> Filter by SNS </strong>
						<div class="make-switch switch-mini" id="selectAll_2">
							<input type="checkbox" id="rowSelectAllc">
						</div>
						<div class="row">
							<div class="col-lg-6 toggle-state-switch2">
								<input type="checkbox" id="inlineCheckbox_facebook" value="option1"> facebook
							</div><!-- /.col-lg-6 -->
							<div class="col-lg-6 toggle-state-switch2">
								<input type="checkbox" id="inlineCheckbox_twitter" value="option2"> twitter
							</div><!-- /.col-lg-6 -->
						</div><!-- /.row -->
					</div>
				</div>
			</div>
			
			<!--  RESULTS -->
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
                                                   
                                        </tbody>
                                    </table>
                                     <div class="animation_image" style="display:none; aligh:center;"><img src="images/ajax-loader.gif"> Loading...</div>
				</div>
			</div>

			<hr></hr>
			<?php include("footer.php") ?>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-1.8.3.min.js"></script>
		<script src="js/checkboxToogle.js"></script>
		<script src="js/bootstrap-switch.min.js"></script>
                <script src="js/load_results.js"></script>
		
</script>
	</body>
</html>