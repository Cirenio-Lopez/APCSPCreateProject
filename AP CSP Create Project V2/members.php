<?php 
    $result = mysqli_query($link, $query);
    if(mysqli_num_rows($result) >  0):
        while($row = mysqli_fetch_array($result)):
?>
    <div class="team-col">
        <div class="team-item content-box">
        <?php if (isset($_SESSION['logged_in'])) : ?>
            <a class="fa fa-pen editable" id="edit-toggle" href="#/" style= "right: 10px;"></a>
            <a class="fa fa-window-close editable" id="edit-toggle" href="#/" style= "right: -15px;"></a>
            <div id="edit-overlay-image" class="edit-overlay">
                <div class="overlay-content">
                    <span class="close" id="close-edit-image">&times;</span>
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
            <div class="image">
                <img src="<?php echo $row['image'] ?>" alt="<?php echo $row['description'] ?>" />
            </div>
            <div class="desc">
                <div class="name"><?php echo $row['name'] ?></div>
                <div class="category"><?php echo $row['position'] ?></div>
            </div>
        </div>
    </div>
    <?php endwhile; endif ?>