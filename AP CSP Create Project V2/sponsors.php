<?php
	include('server/cms.php');
	//session_start();
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
		<title>Sponsors - 9045 Motorheads</title>
		<?php include('server/head.php') ?>
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
									<li class="menu-item">
										<a href="/">Home</a>
									</li>
									<li class="menu-item">
										<a href="team.php">Team</a>
									</li>
									<li class="menu-item  current-menu-item">
										<a href="sponsors.php">Sponsors</a>
									</li>
									<li class="menu-item">
										<a href="awards.php">Awards</a>
									</li>
									<li class="menu-item">
										<a href="gallery.php">Gallery</a>
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
				<!-- Section Custom Text -->
				<div class="section custom-text" id="section-custom-text">
					<div class="content">
						<!-- title -->
						<div class="title">
							<div class="title_inner">Sponsors
								<?php if (isset($_SESSION['logged_in'])) : ?>
									<a class="fa fa-plus editable" id="add-toggle" href="#/" style= "right: -30px; top: 5px;"></a>
									<div id="add" class="edit-overlay">
									<div class="overlay-content">
										<span class="close" id="close-toggle-add">&times;</span>
										<form action="server/cms.php" method="POST" enctype="multipart/form-data" id="member-form">
											Sponsor Name: <input type="text" name="name" placeholder="John Doe" required/>
											Description: <input type="text" name="description" placeholder="Something about the sponsor." required/>
											Image: <input type="file" name="sponsor-image" required/>
											<input type="hidden" value = "sponsor-image" name = "id">
											<button name="new_sponsor">Submit</button>
										</form>
									</div>
									</div>
								<?php endif ?>
							</div>
						</div>
						<!-- clients items -->
						<div class="content-box">
							<div class="single-post-text" id="main-sponsor">
							<?php if (isset($_SESSION['logged_in'])) : ?>
								<a class="fa fa-ellipsis-h editable" id="edit-toggle-main" href="#/"></a>
								<div class="edit-menu" id="ellipsis">
									<a href="#/" id="edit-overlay-btn">Edit content</a><br>
									<a href="#/" id="edit-img-btn">Edit image</a>
								</div>
								<div id="edit-overlay" class="edit-overlay">
									<div class="overlay-content">
										<span class="close" id="close-toggle-content">&times;</span>
										<div id="toolbar"></div>
										<div id="editor"></div>
										<button id="submit_edit">Submit</button>
									</div>
								</div>
								<div id="edit-overlay-image" class="edit-overlay">
									<div class="overlay-content">
										<span class="close" id="close-toggle-image">&times;</span>
										<form action="server/cms.php" method="POST" enctype="multipart/form-data">
											<?php include('server/errors_session.php'); ?>
											<input type="file" name="team-image" />
											<input type="hidden" name="id" value="team-image" />
											<input type="hidden" name="file-location" value="team" />
											<button name="submit_image">Submit</button>
										</form>
									</div>
								</div>
							<?php endif ?>
							<?php 
								$select = "SELECT * FROM `index` WHERE content='main-sponsor';";
								$result = mysqli_query($link, $select);
								if($result)
								{
									$content = mysqli_fetch_assoc($result);
									echo $content["description"];
								}
							?>
							<div class="image">
								<?php
									$sql = "SELECT `image` FROM `images` WHERE `name` = 'sponsor-image';";
									$result = mysqli_query($link ,$sql);
									if($row = mysqli_fetch_array($result))
									{
										$image = $row['image'];
										echo "<img src='$image' >";
									}
								?>
							</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<!-- Section Sponsor -->
				<?php
					$query = "SELECT * FROM `sponsor`;";
					include('add_sponsors.php');
				?>
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
		<?php include('server/scripts.php'); ?>
	</body>
</html>