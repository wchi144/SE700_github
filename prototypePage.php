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
		<!--

		 Main jumbotron for a primary marketing message or…

		-->
		<div class="jumbotron">
			<div class="container">
				<h1>
					Geolocation Service
				</h1>
				<p>
					A geolocation service to illustrate artist popularity across the globe via SNS
				</p>
			</div>
		</div>

		<div class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header"></div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="home.php">Home</a>
						</li>
						<li>
							<a href="prototypePage.php">Prototype</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div id="map_canvas"></div>
				</div>	
				<div class="col-md-4">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									City
								</th>
								<th>
									Country
								</th>
								<th>
									People Count
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Auckland</td>
								<td>New Zealand</td>
								<td>100</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>50</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
					
					
			</div>

			<hr></hr>
			<footer>
				<p>

					© SE700 szha460 wchi144 2014

				</p>
			</footer>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

