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
		<title>Awards - 9045 Motorheads</title>
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
									<li class="menu-item">
										<a href="sponsors.php">Sponsors</a>
									</li>
									<li class="menu-item  current-menu-item">
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
							<div class="title_inner">Our Awards
								<?php if (isset($_SESSION['logged_in'])) : ?>
									<a class="fa fa-plus editable" id="add-toggle" href="#/" style= "right: -30px; top: 5px;"></a>
									<div id="add" class="edit-overlay">
									<div class="overlay-content">
										<span class="close" id="close-toggle-add">&times;</span>
										<form action="server/cms.php" method="POST" enctype="multipart/form-data" id="award-form">
											Award Name: <input type="text" name="award" placeholder="Inspire Award" required/>
											Description: <input type="text" name="description" placeholder="Something about the award." required/>
											Year: <select name="year" form="award-form">
												<?php
													$query = "SELECT * FROM `award_year`;";
													$result = mysqli_query($link, $query);
													if(mysqli_num_rows($result) >  0):
														while($row = mysqli_fetch_array($result)):
												?>
												<option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
												<?php endwhile; endif ?>
											</select>
											Image: <input type="file" name="award-image" required/>
											<input type="hidden" value = "award-image" name = "id">
											<button name="new_award">Submit</button>
										</form>
									</div>
									</div>
								<?php endif ?>
							</div>
						</div>
						<!-- clients items -->
						<div class="content-box">
							<div class="single-post-text" id="main-award">
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
											<input type="file" name="team-image" />
											<input type="hidden" name="id" value="team-image" />
											<input type="hidden" name="file-location" value="team" />
											<button name="submit_image">Submit</button>
										</form>
									</div>
								</div>
							<?php endif ?>
							<?php 
								$select = "SELECT * FROM `index` WHERE content='main-award';";
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
				<div class="section works" id="section-portfolio">
					<div class="content">
						<!-- portfolio filter -->
						<?php if (isset($_SESSION['logged_in'])) : ?>
							<a class="fa fa-pen editable" id="edit-toggle" href="#/" style= "right: 10px;" onclick="$('#edit').toggle();"></a>
							<a class="fa fa-window-close editable" id="delete-toggle" href="#/" style= "right: -15px;" onclick="$('#delete').toggle();"></a>
							<div id="delete" class="edit-overlay">
								<div class="overlay-content">
									<span class="close" id="close-toggle-delete" onclick="$('#delete').toggle();">&times;</span>
									<form action="server/cms.php" method="POST" enctype="multipart/form-data" id="delete_award_year">
										<p>Do you want to delete an award year?</p>
											Select Year: <select name="year" form="delete_award_year">
												<?php
													$query = "SELECT * FROM `award_year`;";
													$result = mysqli_query($link, $query);
													if(mysqli_num_rows($result) >  0):
														while($row = mysqli_fetch_array($result)):
												?>
												<option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
												<?php endwhile; endif ?>
											</select>
										<button name="delete_award_year" style="margin-left: 50px;">Submit</button>
									</form>
								</div>
							</div>
							<div id="edit" class="edit-overlay">
								<div class="overlay-content">
									<span class="close" id="close-toggle-edit" onclick="$('#edit').toggle();">&times;</span>
									<form action="server/cms.php" method="POST" enctype="multipart/form-data" id="member-form">
										Add new year: <input type="text" name="year" placeholder="Ex: 2019-2020: Skystone" required/>
										<button name="new_award_year">Submit</button>
									</form>
								</div>
							</div>
						<?php endif ?>
						<div class="filter-menu content-box">
							<div class="filters">
								<div class="btn-group">
									<label data-text="All" class="glitch-effect"><input type="radio" name="fl_radio" value=".box-item" />All</label>
								</div>
								<?php
									$query = "SELECT * FROM `award_year`;";
									$result = mysqli_query($link, $query);
									if(mysqli_num_rows($result) >  0):
										while($row = mysqli_fetch_array($result)):
								?>
								<div class="btn-group">
									<label data-text="Image"><input type="radio" name="fl_radio" value=".f-<?php echo $row['id'] ?>" /><?php echo $row['name'] ?></label>
								</div>
								<?php endwhile; endif ?>
							</div>
						</div>
						<!-- portfolio items -->
						<div class="box-items portfolio-items">
							<?php
								$query = "SELECT `awards`.*,`award_year`.* FROM `award_year` INNER JOIN `awards` ON `award_year`.`name` = `awards`.`year`;";
								$result = mysqli_query($link, $query);
								if(mysqli_num_rows($result) >  0):
									while($row = mysqli_fetch_array($result)):
							?>
							<div class="box-item f-<?php echo $row['id'] ?>">
								<?php if (isset($_SESSION['logged_in'])) : ?>
									<a class="fa fa-window-close editable" id="delete-toggle" href="#/" onclick="$('#delete_award').toggle();"></a>
									<div id="delete_award" class="edit-overlay">
										<div class="overlay-content">
											<span class="close" id="close-toggle-delete" onclick="$('#delete_award').toggle();">&times;</span>
											<form action="server/cms.php" method="POST" enctype="multipart/form-data" id="delete_award_year">
												<p>Do you want to delete this award?</p>
												<input type="hidden" value="<?php echo $row['award_id'] ?>" name="award_id">
												<button name="delete_award">Yes</button> <button style="margin-left: 50px;" onclick="$('#delete').toggle();" type="button">No</button>
											</form>
										</div>
									</div>
								<?php endif ?>
								<div class="image">
									<a href="<?php echo $row['image'] ?>" class="has-popup-image hover-animated">
										<img src="<?php echo $row['image'] ?>" class="wp-post-image" alt="" />
										<span class="info circle">
											<span class="centrize full-width">
												<span class="vertical-center">
													<span class="icon fas fa-image"></span>
													<span class="desc">
														<span class="name"><?php echo $row['award'] ?></span>
														<span class="category"><?php echo $row['description']?></span>
														<span class="category"><?php echo $row['year'] ?></span>
													</span>
												</span>
											</span>
										</span>
									</a>
								</div>
							</div>
							<?php endwhile; endif ?>
						</div>
						<div class="clear"></div>
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