<?php
    include("config.php");
    session_start();

    $errors = array();
    $username = "";
    // LOGIN USER
    if (isset($_POST['login_user'])) 
    {
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $password = mysqli_real_escape_string($link, $_POST['password']);
    
        if (empty($username)) 
        {
            array_push($errors, "Username is required");
        }
        if (empty($password)) 
        {
            array_push($errors, "Password is required");
        }
    
        if (count($errors) == 0) 
        {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $results = mysqli_query($link, $query);

            if (mysqli_num_rows($results) == 1) 
            {
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = TRUE;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            }
            else 
            {
                array_push($errors, "Wrong username or password");
            }
        }
  }
?>