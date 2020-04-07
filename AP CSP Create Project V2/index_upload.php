<?php
    include('config.php');
    session_start();
    $delete = "DELETE FROM `index` WHERE content='Main';";
    if (mysqli_query($link, $delete))
    {
        echo "lol";
    }
    $description = $_POST['description'];
    $sql_insert = "INSERT INTO `index` (content, description) VALUES ('Main', '$description');";
    if (mysqli_query($link, $sql_insert))
    {
        $_SESSION['success'] = "New record created successfully";
        header('location: index.php');
    }
    else
    {
        $_SESSION['success'] = "Could not post: ". $sql_insert . mysqli_error($link);
        header('location: index.php');
    }
?>