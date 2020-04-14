<?php
    //something cool I learned, if a colon is used, then the html or php code is executed until the statement is ended.
    if (isset($_SESSION['errors'])) :
?>
<div class="errors">
    <!-- Another cool thing I learned, each string in an array an be assigned as the same variable using foreach. Basically a for loop starting from beginning to end. -->
    <?php foreach($_SESSION['errors'] as $error) : ?>
        <p><?php echo $error ?></p>
    <?php endforeach ?>
</div>  
<?php
    $_SESSION['errors'] = array();
endif ?>
