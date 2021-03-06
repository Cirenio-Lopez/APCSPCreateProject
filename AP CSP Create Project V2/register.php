<?php include('server/entry.php') ?>
<!doctype html>
<html lang="en-US">
	<head>
		<!-- Meta -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="description" content="Greenhill Robotics Team 9045 Motorheads" />
		<meta name="keywords" content="Greenhill, Robotics, FTC" />
		<meta name="author" content="Greenhill School" />
		<!-- Title -->
		<title>Gallery - 9045 Motorheads</title>
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=cyrillic" rel="stylesheet">
		<!-- Styles -->
		<link rel="stylesheet" href="styles/css/basic.css" />
		<link rel="stylesheet" href="styles/css/layout.css" />
		<link rel="stylesheet" href="styles/css/magnific-popup.css" />
		<link rel="stylesheet" href="styles/css/animate.css" />
		<link rel="stylesheet" href="styles/css/jarallax.css" />
		<link rel="stylesheet" href="styles/css/swiper.css" />
		<link rel="stylesheet" href="styles/css/fontawesome.css" />
		<link rel="stylesheet" href="styles/css/brands.css" />
		<link rel="stylesheet" href="styles/css/solid.css" />
		<link rel="shortcut icon" href="#">
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader">
			<div class="centrize full-width">
				<div class="vertical-center">
					<div class="spinner">
						<div class="double-bounce1"></div>
						<div class="double-bounce2"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container -->
		<div class="container">
			<!-- Header -->
			<header class="header">
				<div class="head-top">
					<!-- menu button -->
					<a href="#" class="menu-btn"><span></span></a>
					<!-- logo -->
					<div class="logo hover-masks-logo">
						<a href="/">
							<span class="mask-lnk">Motorheads <strong>Robotics</strong></span>
							<span class="mask-lnk mask-lnk-hover">Team <strong>9045</strong></span>
						</a>
					</div>
					<!-- top menu -->						
					<div class="top-menu hover-masks">
						<div class="top-menu-nav">	
							<div class="menu-topmenu-container">
								<ul class="menu">
									<li class="menu-item">
										<a href="/">Home</a>
									</li>
									<li class="menu-item">
										<a href="team.php">Team</a>
									</li>
									<li class="menu-item">
										<a href="sponsors.html">Sponsors</a>
									</li>
									<li class="menu-item">
										<a href="awards.html">Awards</a>
									</li>
									<li class="menu-item">
										<a href="resources.html">Resources</a>
									</li>
									<li class="menu-item">
										<a href="gallery.html">Gallery</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- Wrapper -->
			<div class="wrapper">
				<!-- Section Started -->
                <div class="section started layout-creative" id="section-started">
					<div class="video-bg jarallax" style="background-image: url(styles/img/motorheads_logo_updated_3-14-20.svg);">
					</div>
				</div>
				<!-- Section Register Form -->
				<div class="section contacts" id="section-contacts">
					<div class="content">
						<!-- title -->
						<div class="title">
							<div class="title_inner">Register Form</div>
						</div>
						<div class="subtitle">
							<div class="subtitle_inner">ONLY USED BY ADMINISTRATORS</div>
						</div>
						<!-- form -->
						<div class="contact_form content-box">
							<form method="post" action="server/entry.php">
								<?php include('server/errors.php'); ?>
								<div class="group-val">
									<input type="text" name="name" placeholder="Name" value="<?php echo $name ?>" />
								</div>
								<div class="group-val">
									<input type="email" name="email" placeholder="Email" value="<?php echo $email ?>" />
								</div>
								<div class="group-val">
									<input type="text" name="username" placeholder="Username" value="<?php echo $username ?>" />
								</div>
								<div class="group-val">
									<input type="password" name="password" placeholder="Password"/>
								</div>
								<div class="group-bts">
									<button type="submit" class="btn hover-animated" name="login_user">
										<span class="circle"></span>
										<span class="lnk">Submit</span>
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<!-- Lines -->
			<div class="lines">
				<div class="line-col"></div>
				<div class="line-col"></div>
				<div class="line-col"></div>
				<div class="line-col"></div>
				<div class="line-col"></div>
			</div>
		</div>
		<!-- Scripts -->
		<script src="styles/js/jquery.min.js"></script>
		<script src="styles/js/jquery.validate.js"></script>
		<script src="styles/js/magnific-popup.js"></script>
		<script src="styles/js/simpleParallax.js"></script>
		<script src="styles/js/typed.js"></script>
		<script src="styles/js/jarallax.js"></script>
		<script src="styles/js/jarallax-video.js"></script>
		<script src="styles/js/jarallax-element.js"></script>
		<script src="styles/js/imagesloaded.pkgd.js"></script>
		<script src="styles/js/isotope.pkgd.js"></script>
		<script src="styles/js/swiper.js"></script>
		<script src="styles/js/grained.js"></script>
		<script src="styles/js/scripts.js"></script>
	</body>
</html>