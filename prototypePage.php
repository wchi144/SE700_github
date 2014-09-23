<!--Main Page-->
<!--The prototype page where input is obtained and output is displayed in a form of a heat map.-->
<!--By Shiyi Zhang and Wei-Ling Chin-->
<!DOCTYPE HTML>
<html>
	<head>
		<title>Prototype - Geolocation Services</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.scrollgress.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization"></script>	
        <script src="js/table_cnt.js"></script>
        <script src="js/prototypePHP.js"></script> 
        <script src="js/Map_Table.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/style-noscript.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	
	<!-- The body part of the prototype page -->
	<body class="contact">
	
		<!-- Header -->
		<header id="header" style="background-image: url('images/headerPink.jpg'); background-size:100%">
			<h1 id="logo"><a href="home.php">Project #100</a></h1>
			<nav id="nav">
				<ul>
					<li class="current"><a href="home.php">Welcome</a></li>
					<li><a href="prototypePage.php" class="button special">Prototype</a></li>
				</ul>
			</nav>
		</header>
		
		<!-- Main -->
		<article id="main">
		
			<!-- Section -->
			<section class="wrapper style4 special container small" style="width:1200px">
				<p style="size:10px; margin-left:0px; float:left"><span class="fa fa-search fa-3x"></span>
					Search an artist name and see their popularity distribution on the heatmap below.</p>
						
				<!-- Search Section, including the text input and a search button -->
				<div class="content">
					<div class="row half no-collapse-1">
						<div class="7u" id="inputForm" style="width:70%">
							<input type="text" class="form-control" id="searchBox" name="searchBox" placeholder="Text input" />
						</div>
						<div class="3u">
							<ul class="buttons" style="width:30%">
								<li>
									<button type="button" class="button special" id="searchButton" onclick = "load_results()">
										<a href="#" id="searchBookmark" style="font:inherit; text-decoration:none; color:white; border:15px solid transparent" >Search</a>
									</button>
								</li>
							</ul>
						</div>
					</div>			
				</div>
						
				<!-- Filter section, including the dropdown filter and checkboxes for different options -->
				<div class="filter">
					<a id="anchorBeforeExpand" name="map" style="text-decoration:none; color:inherit">
						<div class="filterTitle" onClick="filterTitleClick()" style="cursor:pointer; width:100%; height:100px; ">
							<p style="size:10px; float:left; margin: 0 0 0 0; padding-top:20px"><span class="fa fa-filter fa-3x"></span>
								Click and filter the results using different social media and geolocation methods.
							</p> 
							<div class="space" style="width:80px; float:left; height:10px">
							</div>
							<p class="toggleArrow" style="float:right; margin-right:40px; padding-top:20px; display:block">
								<span id="toggle-icon" class="fa fa-arrow-down fa-3x"></span>
							</p>
							<p class="toggleArrowUp" style="float:right; margin-left:996px; margin-top:-3px; padding-top:20px; visibility:hidden; position:absolute">
								<span id="toggle-icon-up" class="fa fa-arrow-up fa-3x"></span>
							</p>
						</div>
					</a>
						
					<!-- Checkboxes -->
					<div class="checkboxes" id="checkboxes" style="display:none; padding-top:10px; width:100%; height:200px; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);">
						
						<!-- Filter By SNS Title, including the selectAll checkbox -->
						<div class="filterSNSTitle" style="width:50%; height:32px; text-align:center; vertical-align:middle; float:left">
							<strong style="margin:0 0 0 0; padding-left:10px; float:left; text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);"> Filter by SNS </strong>
							<label class="checkbox2" for="rowSelectAllc2" style="padding-left:81px; margin-top:10px float:left;">Select All</label>
							<input style="margin-left:10px;" onClick="toggleSNS(this)" type="checkbox" id="rowSelectAllc2"> 
						</div>
						
						<br>
						
						<!-- Facebook and Twitter -->
						<div class="row_sns" style="margin-top:5px; height:32px; width:70%; vertical-align:middle; ">
							<div class="col-lg-6 toggle-state-switch2" style="float:left; margin:0 0 0 0; padding:0 0 0 0; height:32px; vertical-align:middle">
								<span class="fa fa-facebook-square fa-1x" style="float:left; padding-left:10px; vertical-align:middle; padding-top:7px"></span>
								<label class="checkbox2" for="inlineCheckbox_facebook" style="float:left; padding-left: 5px">Facebook</label>
								<input style="margin-left:10px; float:left; vertical-align:middle; margin-top:10px" onClick="facebookClicked(this)" name="sns" type="checkbox" id="inlineCheckbox_facebook" value="facebook"/>
							</div>
							<div class="col-lg-6 toggle-state-switch2" style="float:left; vertical-align:middle;">
								<span class="fa fa-twitter-square fa-1x" style="padding-left:175px; margin-left:5px; padding-top:7px; float:left"></span>
								<label class="checkbox2" for="inlineCheckbox_twitter" style="float:left; padding-left:5px">Twitter</label>
								<input style="margin-left:10px; float:left; margin-top:10px" name="sns" type="checkbox" onClick="twitterClicked(this)" id="inlineCheckbox_twitter" value="twitter"/>
							</div>
						</div>
						
						<hr style="border: 0; height: 10px; background: white; box-shadow: -2px 2px 2px #83d3c9; width:100%">
						
						<!-- Filter By Result Type Title, including the selectAll checkbox -->
						<div class="filterTypeTitle" style="width:100%; height:32px; text-align:center; vertical-aligh:center; float:left">
							<a id="anchorAfterExpand" name="mapExpand" style="text-decoration:none; color:inherit">
								<strong style="margin:0 0 0 0; padding-left:10px; padding-top:0px; float:left;text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);"> Filter by result types </strong>
								<label class="checkbox2" for="rowSelectAllc" style="padding-left:131px; float:left">Select All</label>
								<input type="checkbox" onClick="toggleType(this)" id="rowSelectAllc" style="float:left; margin-left:10px; margin-top:10px;">
							</a>
						</div>
									
						<br>
							
						<!-- Four Result Types -->
						<div class="row_type" style="margin-top:5px; width:100%; height:32px; vertical-align:middle;">
							<div class="col-lg-6 toggle-state-switch1" style="float:left; vertical-align:middle;margin:0 0 0 0; padding:0 0 0 0; height:32px; ">
								<span class="fa fa-tag" style="float:left; padding-left:10px; vertical-align:middle; padding-top:7px"></span>
								<label class="checkbox2" for="inlineCheckbox_geotagged" style="padding-left:5px">Geotagged</label>
								<input style="margin-left:10px; margin-top:10px" name="result" type="checkbox" onClick="geotagClicked(this)" id="inlineCheckbox_geotagged" value="geotagged"/> 
							</div>
							<div class="col-lg-6 toggle-state-switch1" style="float:left; vertical-align:middle;">
								<span class="fa fa-user" style="padding-left:120px; float:left; vertical-align:middle; padding-top:7px"></span>
								<label class="checkbox2" for="inlineCheckbox_user" style="padding-left:5px">User Profile</label>
								<input style="margin-left:10px; margin-top:10px" name="result" type="checkbox" onClick="profileClicked(this)" id="inlineCheckbox_profile" value="profile"/>
							</div>
							<div class="col-lg-6 toggle-state-switch1" style="float:left; vertical-align:middle;">
								<span class="fa fa-language" style="padding-left:120px; float:left; vertical-align:middle; padding-top:7px"></span>
								<label class="checkbox2" for="inlineCheckbox_geo-words" style="padding-left:5px">Geo-words</label>
								<input style="margin-left:10px; margin-top:8px" name="result" type="checkbox" onClick="geowordClicked(this)" id="inlineCheckbox_geoword" value="geoword"/> 
							</div>
							<div class="col-lg-6 toggle-state-switch1" style="float:left; vertical-align:middle;">
								<span class="fa fa-users" style="padding-left:120px; float:left; vertical-align:middle; padding-top:7px"></span>
								<label class="checkbox2" for="inlineCheckbox_networking" style="padding-left:5px">Networking</label>
								<input style="margin-left:10px; margin-top:8px" name="result" type="checkbox" onClick="networkingClicked(this)" id="inlineCheckbox_networking" value="networking"/>
							</div>
						</div>	
					</div>
				</div>
							
							
				<!-- Map and Results Section -->	
				<div class="mapAndResults" style="margin-top:20px; padding-top:0px; width:100%; height:600px">
				
					<!-- Google Map Section -->
					<div class="mapSection" style="width:65%; height:100%; float:left; margin-top:0px;">
						<div class="map" id="map_canvas" style="width:100%; height: 100%;">
							<p>Google Map Here!</p>
						</div>	
					</div>
								
					<!-- Results Tabs -->
                    <div class="resultsTabs" style="height:100%; width:35%;padding-left:10px; margin-top:0px; float:left">
						
						<!-- Navigation Menu -->
						<div class="resultsTabsTitle" style="width:100%; height:10%" >
							<ul>
								<li class="active" onClick="tabs(1)" name="tab" id="tab_1"><a href='#results'><span>Results</span></a></li>
								<li onClick="tabs(2)" name="tab" id="tab_2"><a href='#tweets'><span>Tweets</span></a></li>
								<li onClick="tabs(3)" name="tab" id="tab_3"><a href='#inputs'><span>Inputs</span></a></li>
								<li class="last" onClick="tabs(4)" name="tab" id="tab_4"><a href='#outputs'><span>Outputs</span></a></li>
							<ul>
                        </div>

						<!-- Tab Contents -->
						<div class="content" style="margin-top:0px; padding-top:0px;width:100%; height:80%;overflow-y: auto; overflow-x:hidden">
						
							<!-- Results Table -->
							<div class="resultsTab" name="tab_content" id="tab_content_1">
								<table class="resultsTable" id="results_table" >
									<thead>
										<tr>
											<th>
												Country
											</th>
											<th>
												City
											</th>   
											<th>
												Lat, Long
											</th>                                                         
											<th>
												Count
											</th>
										</tr>
									</thead>
									<tbody class="dataBody">
									</tbody>
								</table>
                                 
								<div class="animation_image" style="display:none; align:center; padding-left:140px"><img src="images/ajax-loader.gif"> Loading...</div>
							</div>
							
							<!-- Tweets Table -->
							<div class="tweetsTab" name="tab_content" id="tab_content_2" style="display:none">
								<table class="resultsTable" id="tweet_table">
									<thead>
										<tr>
											<th>
												user_id
											</th>
											<th>
												tweet_text
											</th>
										</tr>
									</thead>
									<tbody class="tweet_table_body" id="tweet_table_body">                    
									</tbody> 
								</table>
								<div class="animation_image_2" style="display:none; align:center; padding-left:140px"><img src="images/ajax-loader.gif"> Loading...</div>
							</div>
							
							<!-- Inputs -->
							<div class="inputsTab" name="tab_content" id="tab_content_3" style="display:none">
							</div>
							
							<!-- Outputs -->
							<div class="outputsTab" name="tab_content" id="tab_content_4" style="display:none">
							</div>
						</div>
                                                    
                        <!-- Data Buttons -->
						<div class="buttons" style="width:100%; height:10%; margin-top:5px; padding-top:5px">
							<div class="buttonContainer" style="float:left">
                                <button type="button" class="customizeButton" style="float:left; width:85px; margin-right:6px; text-align:center" id="dataButton" onclick = "showData()"> Data
                                </button>
                                <button type="button" class="customizeButton" style="float:left; width:85px; margin-right:6px; text-align:center" id="dataButton" onclick = "showMap()"> Map
                                </button>
                                <button type="button" class="customizeButton" style="float:left; width:180px; margin-right:0px;  text-align:center" id="countButton" onclick = "table_cnt()"> Sort Data
                                </button>
							</div>
						</div>
                    </div>	
				</div>		
			</section>
		</article>
        <!--Make enter key also trigger search button-->
        <script type="text/javascript">                
            $("#searchBox").keyup(function(event){
                if(event.keyCode == 13){
                    $("#searchButton").click();
                }
            });
        </script>

		<!-- Footer -->
		<footer id="footer">
			<ul class="copyright">
				<li>&copy; 2014 SE700</li><li>Design: szha460 & wchi144</li>
			</ul>
		</footer>    
	</body>
</html>