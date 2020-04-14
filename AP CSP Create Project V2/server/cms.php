<?php
    include('config.php');
    session_start();
    //GENERAL
    $content_stripped = '';
    $id = '';
    $url = '';
    if (isset($_POST['content']))
    {
        $content_stripped = strip_tags($_POST['content']);
        $id = $_POST['id'];
        $url = $_POST['curr_url'];
        if ($content_stripped == "")
        {
            $_SESSION['error'] = "Invalid input. Please try again";
            header("location:javascript://history.go(-1)");
        }
    }
    //Index Page
    if ($id == "Main-Index")
    {
        edit_post_text($id, $url, $link);
    }
    //Team Page
    if ($id == "team-description")
    {
        edit_post_text($id, $url, $link);
    }
    //Edit team page: team-image
    if (isset($_POST['submit_image']))
    {
        $id = $_POST['id'];
        edit_image($id, $link);
    }
    if (isset($_POST['new_member']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $position = $_POST['position'];
        $description = $_POST['description'];
        $class = $_POST['class'];
        new_member($link, $id, $name, $position, $description, $class);
    }

    function new_member($conn, $id, $name, $position, $description, $class)
    {
        $name_cleaned = mysqli_real_escape_string($conn, $name);
        $position_cleaned = mysqli_real_escape_string($conn, $position);
        $description_cleaned = mysqli_real_escape_string($conn, $description);
        $image = add_image($id);
        $query = "INSERT INTO `team` (name, class, position, description, image) VALUES ('$name_cleaned','$class','$position_cleaned','$description_cleaned','$image');";

        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Successfully Posted";
            header("location: ../team.php");
        }
        else
        {
            $_SESSION['error'] = "Could not post: ". mysqli_error($conn);
            header("location: ../team.php");
        }
    }
    function add_image($id)
    {
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["$id"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        $name = $_FILES["$id"]["name"];
        if (in_array($imageFileType,$extensions_arr))
        {
            $image_base64 = base64_encode(file_get_contents($_FILES[$id]['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
            move_uploaded_file($_FILES[$id]['tmp_name'],$target_dir.$name);
            return $image;
        }
    }
    function edit_image($id_name, $conn)
    {
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["$id_name"]["name"]);
        $name = $_FILES["$id_name"]["name"];

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $extensions_arr = array("jpg","jpeg","png","gif");

        if (in_array($imageFileType,$extensions_arr))
        {
            $image_base64 = base64_encode(file_get_contents($_FILES[$id_name]['tmp_name']) );
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
            // Insert record
            $query = "UPDATE `images` SET `image` = '$image' WHERE `name` = '$id_name';";
            if (mysqli_query($conn, $query))
            {
                move_uploaded_file($_FILES[$id_name]['tmp_name'],$target_dir.$name);
                header("location: ../team.php");
            }
            else
            {
                $_SESSION['error'] = "Could not post: ". mysqli_error($conn);
                header("location: ../team.php");
            }
         }
    }

    function delete_image($image, $location)
    {
        $file_ext=strtolower(end(explode('.',$image['image']['name'])));
        $file_name = str_replace('.' . $file_ext, '', $file_ext);
        $file_location = "../styles/img/" . $location . "/";
        if (glob($file_location . $file_name . ".*", GLOB_ERR))
        {
            $temp_file = glob($file_location . $file_name . ".*");
            unlink($temp_file);
        }
        else
        {
            return;
        }
    }

    function edit_post_text($edit_id, $edit_url, $conn)
    {
        /*$delete = "DELETE FROM `index` WHERE content='". $edit_id . "';";
        if (mysqli_query($conn, $delete))
        {
            echo "Changes have been made";
        }
        */
        $content_cleaned = mysqli_real_escape_string($conn, $_POST['content']);
        $sql_insert = "UPDATE `index` SET `description` = '$content_cleaned' WHERE `index`.`content` = '$edit_id';";
        //$sql_insert = "INSERT INTO `index` (content, description) VALUES ('$edit_id', '$content_cleaned');";
        if (mysqli_query($conn, $sql_insert))
        {
            $_SESSION['successful'] = "New record created successfully";
            header('location: '.$edit_url);
        }
        else
        {
            $_SESSION['error'] = "Could not post: ". $sql_insert . mysqli_error($conn);
            header('location: '.$edit_url);
        }
    }
?>