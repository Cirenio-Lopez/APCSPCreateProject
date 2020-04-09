<?php
	include('server/config.php');
	session_start();
?>
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
		<title>Home - 9045 Motorheads</title>
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
		<!-- Text Editor CSS -->
		<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
		<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
	</head>
	<body class="home">
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
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="success">
				<?php
					echo $_SESSION['success'];
					unset($_SESSION['success']);
				?>
			</div>
		<?php endif ?>
		<?php if (isset($_SESSION['error'])) : ?>
			<div class="error">
				<?php
					echo $_SESSION['error'];
					unset($_SESSION['error']);
				?>
			</div>
		<?php endif ?>
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
									<li class="menu-item current-menu-item">
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
                <div class="section started" id="section-started">
                  <div class="video-bg jarallax" style="background-image: url(styles/img/motorheads_logo_updated_3-14-20.svg);">
                  </div>
                  <div class="centrize full-width">
                    <div class="vertical-center">
                      <div class="started-content">
                        <h1 class="h-title" id="Main-Index">
						<?php if (isset($_SESSION['logged_in'])) : ?>
							<a class="fa fa-ellipsis-h editable" id="edit-toggle" href="#"></a>
							<div class="edit-menu" id="ellipsis">
								<a href="#" id="edit-overlay-btn">Edit content</a>
							</div>
							<div id="edit-overlay" class="edit-overlay">
								<div class="overlay-content">
									<span class="close" id="close-edit">&times;</span>
									<div id="toolbar"></div>
									<div id="editor"></div>
									<button id="submit_edit">Submit</button>
								</div>
							</div>
						<?php endif ?>
						<?php 
							$select = "SELECT * FROM `index` WHERE content='Main';";
							$result = mysqli_query($link, $select);
							if($result)
							{
								$content = mysqli_fetch_assoc($result);
								echo $content["description"];
							}
						?>
						</h1>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
			<!-- Lines -->
			<div class="lines">
				<div class="content">
					<div class="line-col"></div>
					<div class="line-col"></div>
					<div class="line-col"></div>
					<div class="line-col"></div>
					<div class="line-col"></div>
				</div>
			</div>
		</div>
		<!-- Scripts -->
		<!-- JQuery Scripts -->
		<script src="styles/js/jquery.min.js"></script>
		<script src="styles/js/jquery.validate.js"></script>
		<!-- Preexisting Scripts (From a previous project) -->
		<script src="styles/js/simpleParallax.js"></script>
		<script src="styles/js/jarallax.js"></script>
		<script src="styles/js/jarallax-video.js"></script>
		<script src="styles/js/jarallax-element.js"></script>
		<script src="styles/js/imagesloaded.pkgd.js"></script>
		<script src="styles/js/isotope.pkgd.js"></script>
		<script src="styles/js/swiper.js"></script>
		<script src="styles/js/grained.js"></script>
		<script src="styles/js/scripts.js"></script>
		<!-- My Scripts -->
		<script>
			$(document).ready(function()
			{
				$("#edit-toggle").click(function()
				{
					$("#ellipsis").toggle();
				});
				$("#edit-overlay-btn").click(function()
				{
					$("#edit-overlay").toggle();
				});
				$("#close-edit").click(function()
				{
					$("#edit-overlay").toggle();
				});
			});
		</script>
		<!-- Text Editor Scripts -->
		<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
		<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
		<script>
			var toolbarOptions = 
			[
				['bold','italic','underline','strike'],
				['blockquote','code-block'],
				[{'header': 1}, {'header': 2}],
				[{'list': 'ordered'}, {'list': 'bullet'}],
				[{'script': 'sub'}, {'script': 'super'}]
				[{ 'indent': '-1'}, { 'indent': '+1' }],
				[{ 'direction': 'rtl' }],
				[{ 'size': ['small', false, 'large', 'huge'] }],
				[{ 'header': [1, 2, 3, 4, 5, 6, false] }],
				[{ 'color': [] }, { 'background': [] }],
				[{ 'font': [] }],
				[{ 'align': [] }],
				['clean']   
			];
			var quill = new Quill('#editor',
			{
				modules:
				{
					toolbar: toolbarOptions
				},
				theme: 'snow'
			});
			$("#submit_edit").click(function ()
			{
				var id = $(this).parent().parent().parent().attr('id');
				var delta = quill.root.innerHTML;
				$.post("cms.php",{content: delta, id: id}, function(){});
				$("#edit-overlay").toggle();
				location.reload();
			});
		</script>
	</body>
</html>