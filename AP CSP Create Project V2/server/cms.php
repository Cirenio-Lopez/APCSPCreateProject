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
    if (isset($_POST['content']))
    {
        edit_post_text($id, $url, $link);
    }
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
    if(isset($_POST['update_member']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $position = $_POST['position'];
        $description = $_POST['description'];
        $class = $_POST['class'];
        $post_id = $_POST['post_id'];
        update_member($link, $id, $name, $position, $description, $class, $post_id);
    }
    if(isset($_POST['delete_member']))
    {
        $id = $_POST['id'];
        delete_member($link, $id);
    }
    if (isset($_POST['new_sponsor']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        new_sponsor($link, $id, $name, $description);
    }
    if (isset($_POST['update_sponsor']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $sponsor_id = $_POST['sponsor_id'];
        update_sponsor($link, $id, $name, $description, $sponsor_id);
    }
    if(isset($_POST['delete_sponsor']))
    {
        $id = $_POST['id'];
        delete_sponsor($link, $id);
    }
    if(isset($_POST['new_award']))
    {
        $id = $_POST['id'];
        $award = $_POST['award'];
        $description = $_POST['description'];
        $year = $_POST['year'];
        new_award($link, $id, $award, $year, $description);
    }
    if(isset($_POST['delete_award']))
    {
        $id = $_POST['award_id'];
        delete_award($link, $id);
    }
    if(isset($_POST['new_award_year']))
    {
        $year = $_POST['year'];
        new_award_year($link, $year);
    }
    if(isset($_POST['delete_award_year']))
    {
        $year = $_POST['year'];
        delete_award_year($link, $year);
    }
    if(isset($_POST['new_gallery']))
    {
        $image_id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $tournament = $_POST['tournament'];
        new_gallery($link, $image_id, $title, $description,  $tournament);
    }
    if(isset($_POST['edit_gallery']))
    {
        $image_id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $tournament = $_POST['tournament'];
        $post_id = $_POST['post_id'];
        edit_gallery($link, $image_id, $title, $description,  $tournament, $post_id);
    }
    if(isset($_POST['delete_gallery']))
    {
        $post_id = $_POST['id'];
        delete_gallery($link, $post_id);
    }
    function delete_member($conn, $id)
    {
        $query = "DELETE FROM `team` WHERE `id` = $id;";
        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Member Successfully deleted";
            header("location: ../team.php");
        }
        else
        {
            $_SESSION['error'] = "Could not delete user: ". mysqli_error($conn);
            header("location: ../team.php");
        }
    }
    function delete_sponsor($conn, $id)
    {
        $query = "DELETE FROM `sponsor` WHERE `id` = $id;";
        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Member Successfully deleted";
            header("location: ../sponsors.php");
        }
        else
        {
            $_SESSION['error'] = "Could not delete user: ". mysqli_error($conn);
            header("location: ../sponsors.php");
        }
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
    function update_member($conn, $id, $name, $position, $description, $class, $post_id)
    {
        $name_cleaned = mysqli_real_escape_string($conn, $name);
        $position_cleaned = mysqli_real_escape_string($conn, $position);
        $description_cleaned = mysqli_real_escape_string($conn, $description);
        $image = add_image($id);
        $query = "UPDATE `team` SET ";
        if(!empty($name_cleaned))
        {
            $query .= "`name` = '$name_cleaned', ";
        }
        if(!empty($position_cleaned))
        {
            $query .= "`position` = '$position_cleaned', ";
        }
        if(!empty($description_cleaned))
        {
            $query .= "`description` = '$description_cleaned', ";
        }
        if(!empty($class))
        {
            $query .= "`class` = '$class', ";
        }
        if(!empty($image))
        {
            $query .= "`image` = '$image', ";
        }
        $query = chop($query, ", ");
        $query .= " WHERE `id` = '$post_id'; ";

        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "<br>Successfully Posted" . $query;
            header("location: ../team.php");
        }
        else
        {
            $_SESSION['error'] = "Could not post: ". mysqli_error($conn);
            header("location: ../team.php");
        }
    }
    function new_sponsor($conn, $id, $name, $description)
    {
        $name_cleaned = mysqli_real_escape_string($conn, $name);
        $description_cleaned = mysqli_real_escape_string($conn, $description);
        $image = add_image($id);
        $query = "INSERT INTO `sponsor` (name, description, image) VALUES ('$name_cleaned', '$description_cleaned','$image');";

        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Successfully Posted";
            header("location: ../sponsors.php");
        }
        else
        {
            $_SESSION['error'] = "Could not post: ". mysqli_error($conn);
            header("location: ../sponsors.php");
        }
    }
    function update_sponsor($conn, $id, $name, $description, $sponsor_id)
    {
        $name_cleaned = mysqli_real_escape_string($conn, $name);
        $description_cleaned = mysqli_real_escape_string($conn, $description);
        $image = add_image($id);
        $query = "UPDATE `sponsor` SET ";
        if(!empty($name_cleaned))
        {
            $query .= "`name` = '$name_cleaned', ";
        }
        if(!empty($description_cleaned))
        {
            $query .= "`description` = '$description_cleaned', ";
        }
        if(!empty($image))
        {
            $query .= "`image` = '$image', ";
        }
        $query = chop($query, ", ");
        $query .= " WHERE `id` = '$sponsor_id'; ";

        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Successfully Posted";
            header("location: ../sponsors.php");
        }
        else
        {
            $_SESSION['error'] = "Could not post: ". mysqli_error($conn);
            header("location: ../sponsors.php");
        }
    }
    function new_award($conn, $id, $award, $year, $description)
    {
        $name_cleaned = mysqli_real_escape_string($conn, $award);
        $description_cleaned = mysqli_real_escape_string($conn, $description);
        $image = add_image($id);
        $query = "INSERT INTO `awards` (award, year, description, image) VALUES ('$name_cleaned', '$year', '$description_cleaned','$image');";

        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Successfully Posted";
            header("location: ../awards.php");
        }
        else
        {
            $_SESSION['error'] = "<br>Could not post: ". mysqli_error($conn);
            header("location: ../awards.php");
        }
    }
    function delete_award($conn, $id)
    {
        $query = "DELETE FROM `awards` WHERE `award_id` = '$id';";

        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Successfully deleted";
            header("location: ../awards.php");
        }
        else
        {
            $_SESSION['error'] = "Could not delete: ". mysqli_error($conn);
            header("location: ../awards.php");
        }  
    }
    function new_award_year($conn, $year)
    {
        $year_cleaned = mysqli_real_escape_string($conn, $year);
        $query = "INSERT INTO `award_year` (name) VALUES ('$year_cleaned');";

        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Successfully Uploaded";
            header("location: ../awards.php");
        }
        else
        {
            $_SESSION['error'] = "Could not post: ". mysqli_error($conn);
            header("location: ../awards.php");
        }
    }
    function delete_award_year($conn, $year)
    {
        $query = "DELETE FROM `award_year` WHERE `name` = '$year';";

        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Successfully deleted";
            header("location: ../awards.php");
        }
        else
        {
            $_SESSION['error'] = "Could not delete: ". mysqli_error($conn);
            header("location: ../awards.php");
        }
    }
    //Dependent functions
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
    function new_gallery($conn, $image_id, $title, $description,  $tournament)
    {
        $title_cleaned = mysqli_real_escape_string($conn, $title);
        $description_cleaned = mysqli_real_escape_string($conn, $description);
        $query = "INSERT INTO `gallery` (title, description, tournament) VALUES ('$title_cleaned', '$description_cleaned','$tournament');";
        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Successfully posted text, ";
        }
        else
        {
            $_SESSION['error'] = "<br>Could not post: ". mysqli_error($conn);
            header("location: ../gallery.php");
        }
        $id_query = mysqli_query($conn, "SELECT `post_id` FROM `gallery` WHERE title = '$title'");
        $row = mysqli_fetch_array($id_query);
        $post_id = $row['post_id'];
        multiple_images($image_id, $post_id, $conn);
    }
    function edit_gallery($conn, $image_id, $title, $description,  $tournament, $post_id)
    {
        $title_cleared = mysqli_real_escape_string($conn, $title);
        $description_cleaned = mysqli_real_escape_string($conn, $description);
        $tournament_cleared = mysqli_real_escape_string($conn, $tournament);
        $query = "UPDATE `gallery` SET ";
        if(!empty($title_cleared))
        {
            $query .= "`title` = '$title_cleared', ";
        }
        if(!empty($description_cleaned))
        {
            $query .= "`description` = '$description_cleaned', ";
        }
        if(!empty($tournament_cleared))
        {
            $query .= "`tournament` = '$tournament_cleared', ";
        }
        $query = chop($query, ", ");
        $query .= " WHERE `post_id` = '$post_id'; ";

        if (mysqli_query($conn, $query))
        {   
            $_SESSION['success'] = "Successfully Updated";
            if(!empty($_FILES["$image_id"]))
            {
                multiple_images($image_id, $post_id, $conn);
            }
            header("location: ../gallery.php");
        }
        else
        {
            $_SESSION['error'] = "<br>Could not post: ". mysqli_error($conn);
            header("location: ../gallery.php");
        }
    }
    function delete_gallery($conn, $post_id)
    {
        $text_query = "DELETE FROM `gallery` WHERE `post_id` = '$post_id';";
        if (mysqli_query($conn, $text_query))
        {   
            $_SESSION['success'] = "Successfully deleted text";
            $image_query = "DELETE FROM `gallery_images` WHERE `post_id` = '$post_id';";
            if (mysqli_query($conn, $image_query))
            {
                $_SESSION['success'] .= "Successfully deleted images";
                header("location: ../gallery.php");
            }
            else
            {
                $_SESSION['error'] = "Could not delete: ". mysqli_error($conn);
                header("location: ../gallery.php");
            }
        }
        else
        {
            $_SESSION['error'] = "Could not delete: ". mysqli_error($conn);
            header("location: ../gallery.php");
        }
    }
    function multiple_images($image_name, $post_id, $conn)
    {
        $countfiles = count($_FILES["$image_name"]['name']);

        for($i=0; $i < $countfiles; $i++)
        {
            // File name
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["$image_name"]["name"][$i]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $extensions_arr = array("jpg","jpeg","png","gif");
            $name = $_FILES["$image_name"]["name"][$i];
            if (in_array($imageFileType,$extensions_arr))
            {
                $image_base64 = base64_encode(file_get_contents($_FILES[$image_name]['tmp_name'][$i]) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                move_uploaded_file($_FILES[$image_name]['tmp_name'][$i],$target_dir.$name);
                $query = "INSERT INTO `gallery_images` (post_id, image) VALUES ('$post_id','$image');";
                if (mysqli_query($conn, $query))
                {
                    $_SESSION['success'] .= "successfully posted images";   
                }
                else
                {
                    $_SESSION['error'] .= "<br>Could not post: ". mysqli_error($conn) . "<br>";
                }
            }
        }
        header("location: ../gallery.php");
    }
?>