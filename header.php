<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css"></link>
</head>
	<div class="jumbotron">
		<div class="transparentBG">
		<div class="container">
			<h1>
				Geolocation Service
			</h1>
			<br>
			<br>
			<p>
				A geolocation service to illustrate artist popularity across the globe via SNS
			</p>
		</div>
		</div>
	</div>

        <!--  NAVIGATION SECTION -->
        <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                        <div class="navbar-header"></div>
                        <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <?php 
                                        $URL = $_SERVER["PHP_SELF"];
                                        $contains_home   = '/home.php';
                                        $contains_prototype   = '/prototypePage.php';
                                        $pos_home = strpos($URL, $contains_home);
                                        $pos_proto = strpos($URL, $contains_prototype);
									
                                    if($pos_home !== false) {
                                    ?>
                                        <li  class="active">
                                                <a href="home.php">Home</a>
                                        </li>
                                        <li>
                                                <a href="prototypePage.php">Prototype</a>
                                        </li>
                                    <?php
                                    } else if ($pos_proto !== false){
                                    ?>
                                        <li>
                                                <a href="home.php">Home</a>
                                        </li>
                                        <li  class="active">
                                                <a href="prototypePage.php">Prototype</a>
                                        </li>
                                    <?php
                                    } 
                                    ?>


                                </ul>
                        </div>
                </div>
        </div>	

</body>
</html>	