<?php
    include("config.php");
    session_start();
    //contains errors that will later be shown to the user if they exist.
    $errors = array();
    $name = "";
    $email = "";
    $username = "";
    /* If the submit button is pressed in register page */
    if(isset($_POST['register_user']))
    {
        //saves submitted data into a variable 
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $password = mysqli_real_escape_string($link, $_POST['password']);

        //checks to see if data is empty, if it is, returns an error
        //array_push is used so that multiple errors can be shown to the user if present.
        if(empty($name))
        {
            array_push($errors, "First and last name are required");
        }
        if(empty($email))
        {
            array_push($errors, "Email is required");
        }
        if(empty($username))
        {
            array_push($errors, "Username is required");
        }
        if(empty($password))
        {
            array_push($errors, "Password is required");
        }
        //checks to see if username already exists.
        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        //connects to database and searches if username exists in database. If true, results variable will be true.
        $results = mysqli_fetch_assoc($link, $user_check_query);
        //If results if a boolean, user will be that same boolean and will store what is true, (whether if a username already exists, it will store that username.)
        $user = mysqli_fetch_assoc($results);

        if ($user) //if user exists, then identifies what is the same (username, email, etc.)
        {
            if ($user['username'] === $username)
            {
                array_push($errors, "Username already exists");
            }
            if ($user['email'] === $email)
            {
                array_push($errors, "Email already exists");
            }
        }

        //Checks to see if the error array contains anything. If not, then the user will be stored into the database.
        if (count($errors) == 0)
        {
            //It encrypts the password so that anyone looking into the database can't see it. (Hashing it technically, not encrypting it.)
            $password = md5($password);
            $query = "INSERT INTO users (name, email, username, password) VALUES ('$name', '$email', '$username', '$password')";
            //Uses connection variable and sends SLQ commands to the database, storing the data from this php file in the database.
            mysqli_query($link, $query);
            //Stores success in a cookie, to be referenced later.
            $_SESSION['success'] = "Account registered <br> <a href='login.php'>Login here</a>";
            header('location: index.php');
        }
    }
?>