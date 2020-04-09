<?php
    include('config.php');
    session_start();
    $content_stripped = strip_tags($_POST['content']);
    $id = $_POST['id'];
    //GENERAL
    if ($content_stripped == "")
    {
        $_SESSION['error'] = "Invalid input. Please try again";
        header("location:javascript://history.go(-1)");
    }
    //Index Page
    elseif ($id == "Main-Index")
    {
        $delete = "DELETE FROM `index` WHERE content='Main';";
        if (mysqli_query($link, $delete))
        {
            echo "Changes have been made";
        }
        $content_cleaned = mysqli_real_escape_string($link, $_POST['content']);
        $sql_insert = "INSERT INTO `index` (content, description) VALUES ('Main', '$content_cleaned');";
        if (mysqli_query($link, $sql_insert))
        {
            $_SESSION['success'] = "New record created successfully";
            header('location: index.php');
        }
        else
        {
            $_SESSION['error'] = "Could not post: ". $sql_insert . mysqli_error($link);
            header('location: index.php');
        }
    }
    //Team Page
    elseif ($id = "team-description")
    {
        $delete = "DELETE FROM `index` WHERE content='". $id . "';";
        if (mysqli_query($link, $delete))
        {
            echo "Changes have been made";
        }
        $content_cleaned = mysqli_real_escape_string($link, $_POST['content']);
        $sql_insert = "INSERT INTO `index` (content, description) VALUES ('$id', '$content_cleaned');";
        if (mysqli_query($link, $sql_insert))
        {
            $_SESSION['success'] = "New record created successfully";
            header('location:javascript://history.go(-1)');
        }
        else
        {
            $_SESSION['error'] = "Could not post: ". $sql_insert . mysqli_error($link);
            header('location:javascript://history.go(-1)');
        }
    }
?>