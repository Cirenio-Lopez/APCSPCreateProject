<?php
$result = mysqli_query($link, $query);
if(mysqli_num_rows($result) >  0):
    while($row = mysqli_fetch_array($result)):
?>
<div class="section blog">
    <div class="content content-box">
        <div class="single-post-text">
            <!-- portfolio content -->
            <div class="portfolio-info portfolio-cols">
                <div class="description-col">
                <?php if (isset($_SESSION['logged_in'])) : ?>
                    <a class="fa fa-pen editable" id="edit-toggle" href="#/" style= "right: 10px;" onclick="$('#edit').toggle();"></a>
                    <a class="fa fa-window-close editable" id="delete-toggle" href="#/" style= "right: -15px;" onclick="$('#delete').toggle();"></a>
                    <div id="delete" class="edit-overlay">
                        <div class="overlay-content">
                            <span class="close" id="close-toggle-delete" onclick="$('#delete').toggle();">&times;</span>
                            <form action="server/cms.php" method="POST" enctype="multipart/form-data">
                                <p>Do you want to delete this sponsor?</p>
                                <button name="delete_sponsor">Yes</button>
                                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                <button name="cancel_delete" style="margin-left: 50px;" onclick="$('#delete').toggle();" type="button">No</button>
                            </form>
                        </div>
                    </div>
                    <div id="edit" class="edit-overlay">
                        <div class="overlay-content">
                            <span class="close" id="close-toggle-edit" onclick="$('#edit').toggle();">&times;</span>
                            <form action="server/cms.php" method="POST" enctype="multipart/form-data" id="member-form">
                                Sponsor Name: <input type="text" name="name" placeholder="John Doe" required/>
                                Description: <input type="text" name="description" placeholder="Something about the sponsor." required/>
                                Image: <input type="file" name="sponsor-image" required/>
                                <input type="hidden" value = "sponsor-image" name = "id">
                                <input type="hidden" value = "<?php echo $row['id']?>" name="sponsor_id">
                                <button name="new_sponsor">Submit</button>
                            </form>
                        </div>
                    </div>
                <?php endif ?>
                    <!-- title -->
                    <div class="title">
                        <div class="title_inner"><?php echo $row['name'] ?></div>
                    </div>
                    <!-- text -->
                    <div class="single-post-text">
                        <p>
                        <?php echo $row['description'] ?>
                        </p>
                        <!-- gallery -->
                        <div class="gallery-item">
                            <p>
                                <img src="<?php echo $row['image'] ?>">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php endwhile; endif ?>

