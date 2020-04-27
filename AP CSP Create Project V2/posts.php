<?php
$result = mysqli_query($link, $query);
if(mysqli_num_rows($result) >  0):
    while($row = mysqli_fetch_array($result)):
?>
<div class="section blog">
    <div class="content content-box">
    <?php if (isset($_SESSION['logged_in'])) : ?>
        <a class="fa fa-pen editable" id="edit-toggle" href="#/" style= "right: 10px;" onclick="$('#edit').toggle();"></a>
        <a class="fa fa-window-close editable" id="delete-toggle" href="#/" style= "right: -15px;" onclick="$('#delete').toggle();"></a>
        <div id="delete" class="edit-overlay">
            <div class="overlay-content">
                <span class="close" id="close-toggle-delete" onclick="$('#delete').toggle();">&times;</span>
                <form action="server/cms.php" method="POST" enctype="multipart/form-data">
                    <p>Do you want to delete this post?</p>
                    <button name="delete_gallery">Yes</button>
                    <input type="hidden" value="<?php echo $row['post_id'] ?>" name="id">
                    <button name="cancel_delete" style="margin-left: 50px;" onclick="$('#delete').toggle();" type="button">No</button>
                </form>
            </div>
        </div>
        <div id="edit" class="edit-overlay">
            <div class="overlay-content">
                <span class="close" id="close-toggle-edit" onclick="$('#edit').toggle();">&times;</span>
                <form action="server/cms.php" method="POST" enctype="multipart/form-data" id="gallery-form">
                    Title: <input type="text" name="title" placeholder="Our Journey to Arkansas" value="<?php echo $row['title'] ?>"/>
                    Description: <input type="text" name="description" placeholder="How was the event" value="<?php echo $row['description'] ?>"/>
                    Tournament: <input type="text" name="tournament" placeholder="Where was it?" value="<?php echo $row['tournament'] ?>"/>
                    Images: <input type='file' name='gallery-image[]' multiple />
                    <input type="hidden" value = "gallery-image" name = "id">
                    <input type="hidden" value = "<?php echo $row['post_id']?>" name = "post_id">
                    <button name="edit_gallery">Submit</button>
                </form>
            </div>
        </div>
    <?php endif ?>
        <div class="single-post-text">
            <!-- portfolio content -->
            <div class="portfolio-info portfolio-cols">
                <div class="description-col">
                    <!-- title -->
                    <div class="title">
                        <div class="title_inner"><?php echo $row['title'] ?></div>
                    </div>
                    <!-- text -->
                    <div class="single-post-text">
                        <?php echo $row['description'] ?>
                        <!-- gallery -->
                        <?php
                        $post_id = $row['post_id'];
                        $query_1 = "SELECT `gallery_images`.* FROM `gallery` INNER JOIN `gallery_images` ON `gallery_images`.`post_id` = '$post_id'";
                        $result_1 = mysqli_query($link, $query_1);
                        if(mysqli_num_rows($result_1) >  0):
                            while($row_1 = mysqli_fetch_array($result_1)):
                        ?>
                            <div class="gallery-item">
                                <p>
                                    <img src="<?php echo $row_1['image'];?>" alt="" />
                                </p>
                            </div>
                        <?php endwhile; endif ?>
                    </div>
                </div>
                <div class="details-col">
                    <!-- title -->
                    <div class="title">
                        <div class="title_inner">Details</div>
                    </div>
                    <!-- details -->
                    <ul class="details-list">
                        <li><strong>Tournament:</strong><?php echo $row['tournament'] ?></li>
                        <li><strong>Date posted:</strong><?php echo $row['date'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php endwhile; endif ?>