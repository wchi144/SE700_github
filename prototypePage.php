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
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>1</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>2</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>3</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>4</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>5</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>6</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>7</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>8</td>
							</tr><tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>9</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>10</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>11</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>12</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>13</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>14</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>15</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>16</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>17</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>18</td>
							</tr>
							<tr>
								<td>Wellington</td>
								<td>New Zealand</td>
								<td>19</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<hr></hr>
			<?php include("footer.php") ?>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

