<?php
    //something cool I learned, if a colon is used, then the html or php code is executed until the statement is ended.
    if (count($errors) > 0) :
?>
<div class="errors">
    <!-- Another cool thing I learned, each string in an array an be assigned as the same variable using foreach. Basically a for loop starting from beginning to end. -->
    <?php foreach($errors as $error) : ?>
        <p><?php echo $error ?></p>
    <?php endforeach ?>
</div>  
<?php endif ?>
<?php
    if (count($success) > 0) :
?>
<div class="errors" style="color: green!important;">
        <?php foreach($success as $single) : ?>
            <p><?php echo $single ?></p>
        <?php endforeach ?>
</div>
<?php endif ?>