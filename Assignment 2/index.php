
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>The Folios - A WebFolio system for students.</title>
		<script type="text/javascript" src="js/pageload.js"> </script> <!-- ensures JS is enabled -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap core CSS -->
		<link href="css/css.css" rel="stylesheet">  <!-- Custom styles for this template -->
		<link href="css/index.css" rel="stylesheet">  <!-- Custom styles for this page -->
	</head>
	<body onload="pageload()">
	
		<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '320356911486185',
				xfbml      : true,
				version    : 'v2.2'
			});
				
			FB.getLoginStatus(function(response) {
				  if (response.status === 'connected') {
					console.log('Logged in.');
					document.getElementById("logincheck").innerHTML = "<p>User ID: " +response.authResponse.userID + "</p>";
				  }
				  else {
					FB.login();
				  }
			});
		};
		
		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"><img src="images/logo.gif"/></a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">WebFolios<span class="caret"></span></a>
							<ul class="dropdown-menu">
							<form class="form-inline">
								<input class="form-control pull-left" placeholder="Search" type="text" style="width:70%">
								<button type="submit" class="btn btn-default pull-right" style="width:30%">Go</button>
							</form>
							<li><a href="#">View All</a></li> 
							</ul>
						</li>
						<!-- PHP CHECK FOR LOGGED IN FB USER. IF TRUE SHOW THE FOLLOWING -->
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dashboard<span class="caret"></span></a>
							<ul class="dropdown-menu">
							<li><a href="#">Manage Comments</a></li> 
								<li><a href="#">Manage Topics</a></li>
								<li><a href="#">Manage Qualifications</a></li> 
							</ul>
						</li>
						 <li><a href="#">Profile</a></li>
					</ul>  
					<ul class="nav navbar-nav navbar-right">
						<li id="logincheck">LOG IN CHECK</li>	
					<!-- END IF STATEMENT
					IF USER IS NOT LOGGED IN -->
					<!-- <li class="loggedin">LOGIN CHECK</li> -->
					<!-- END ELSE -->
					</ul>
				</div><!-- end navbar -->	
			</div>
		</nav>
		<div class="container">
			<div id="nojs">Javascript is needed!</div>
			<div id="content"> 	
				<div class="leftfloat">
				<p class="lead">Welcome users!</p>
				</div>
				<img src="images/placeholderrandom.jpg" class="largeimg"/> 
			</div>	
		</div><!-- end container -->
  </body>
</html>
