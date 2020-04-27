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
		<title>Team - 9045 Motorheads</title>
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
									<li class="menu-item current-menu-item">
										<a href="team.php">Team</a>
									</li>
									<li class="menu-item">
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
							<div class="title_inner">Our History</div>
						</div>
						<!-- clients items -->
						<div class="content-box">
							<div class="image">
								<?php
									$sql = "SELECT `image` FROM `images` WHERE `name` = 'team-image';";
									$result = mysqli_query($link ,$sql);
									$row = mysqli_fetch_array($result);
									$image = $row['image'];
								?>
								<img src='<?php echo $image; ?>' >
							</div>
							<br>
							<div class="single-post-text" id ="team-description">
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
								$select = "SELECT * FROM `index` WHERE content='team-description';";
								$result = mysqli_query($link, $select);
								if($result)
								{
									$content = mysqli_fetch_assoc($result);
									echo $content["description"];
								}
							?>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<!-- Section Team -->
				<div class="section team" id="section-team">
					<div class="content">
						<!-- title -->
						<div class="title">
							<div class="title_inner">Meet The Team							
								<?php if (isset($_SESSION['logged_in'])) : ?>
									<a class="fa fa-plus editable" id="add-toggle" href="#/" style= "right: -30px; top: 5px;"></a>
									<div id="add" class="edit-overlay">
									<div class="overlay-content">
										<span class="close" id="close-toggle-add">&times;</span>
										<form action="server/cms.php" method="POST" enctype="multipart/form-data" id="member-form">
											Name: <input type="text" name="name" placeholder="John Doe" required/>
											Position: <input type="text" name="position" placeholder="Example: Builder, Programmer" required/>
											Description: <input type="text" name="description" placeholder="Something about yourself." required/>
											Class: <select name="class" form="member-form">
												<option value="freshman">Freshmen</option>
												<option value="sophomore">Sophomore</option>
												<option value="junior">Junior</option>
												<option value="senior">Senior</option>
												<option value="alumni">Alumni</option> 
											</select>
											Image: <input type="file" name="member-image" required/>
											<input type="hidden" value = "member-image" name = "id">
											<button name="new_member">Submit</button>
										</form>
									</div>
									</div>
								<?php endif ?>
							</div>
						</div>
						<!-- Senior team -->
						<div class="subtitle">
							<div class="subtitle_inner">Seniors</div>
						</div>
						<div class="team-items">
							<?php
								$query = "SELECT * FROM `team` WHERE `class` = 'senior';";
								include('members.php');
							?>
						</div>
						<!-- Junior team -->
						<div class="subtitle">
							<div class="subtitle_inner">Juniors</div>
						</div>
						<div class="team-items">
							<?php
								$query = "SELECT * FROM `team` WHERE `class` = 'junior';";
								include('members.php');
							?>
						</div>
						<!-- Sophomore team -->
						<div class="subtitle">
							<div class="subtitle_inner">Sophomores</div>
						</div>
						<div class="team-items">
							<?php
								$query = "SELECT * FROM `team` WHERE `class` = 'sophomore';";
								include('members.php');
							?>
						</div>
						<!-- Freshmen team -->
						<div class="subtitle">
							<div class="subtitle_inner">Freshmen</div>
						</div>
						<div class="team-items">
							<?php
								$query = "SELECT * FROM `team` WHERE `class` = 'freshman';";
								include('members.php');
							?>
						</div>
						<!-- Alumni team -->
						<div class="subtitle">
							<div class="subtitle_inner">Alumni</div>
						</div>
						<!-- team items -->
						<div class="team-items">
							<?php
								$query = "SELECT * FROM `team` WHERE `class` = 'alumni';";
								include('members.php');
							?>
						</div>
					</div>
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
		<?php include('server/scripts.php'); ?>
	</body>
</html>