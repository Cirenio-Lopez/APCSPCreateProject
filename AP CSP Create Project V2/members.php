<?php
$result = mysqli_query($link, $query);
if(mysqli_num_rows($result) >  0):
    while($row = mysqli_fetch_array($result)):
?>
<div class="team-col">
    <div class="team-item content-box">
    <?php if (isset($_SESSION['logged_in'])) : ?>
        <a class="fa fa-pen editable" id="edit-toggle" href="#/" style= "right: 10px;" onclick="$('#edit').toggle();"></a>
        <a class="fa fa-window-close editable" id="delete-toggle" href="#/" style= "right: -15px;" onclick="$('#delete').toggle();"></a>
        <div id="delete" class="edit-overlay">
            <div class="overlay-content">
                <span class="close" id="close-toggle-delete" onclick="$('#delete').toggle();">&times;</span>
                <form action="server/cms.php" method="POST" enctype="multipart/form-data">
                    <p>Do you want to delete this member?</p>
                    <button name="delete_member">Yes</button>
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                    <button name="cancel_delete" style="margin-left: 50px;" onclick="$('#delete').toggle();" type="button">No</button>
                </form>
            </div>
        </div>
        <div id="edit" class="edit-overlay">
            <div class="overlay-content">
                <span class="close" id="close-toggle-edit" onclick="$('#edit').toggle();">&times;</span>
                <form action="server/cms.php" method="POST" enctype="multipart/form-data" id="update-form" style="text-align: left;">
                Name: <input type="text" name="name" placeholder="John Doe"/>
                    Position: <input type="text" name="position" placeholder="Example: Builder, Programmer"/>
                    Description: <input type="text" name="description" placeholder="Something about yourself."/>
                    Class: <select name="class" form="update-form">
                        <option value="freshman">Freshmen</option>
                        <option value="sophomore">Sophomore</option>
                        <option value="junior">Junior</option>
                        <option value="senior">Senior</option>
                        <option value="alumni">Alumni</option>
                    </select>
                    Image: <input type="file" name="member-image"/>
                    <input type="hidden" value = "member-image" name = "id">
                    <input type="hidden" value = "<?php echo $row['id']?>" name="post_id">
                    <button name="update_member">Submit</button>
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