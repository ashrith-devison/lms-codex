<?php
require 'config.php';
if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $duplicate = mysqli_query($conn, "SELECT * FROM user_base WHERE username = '$username'");
    
    if ($duplicate) {
        if (mysqli_num_rows($duplicate) > 0) {
            echo "<script>alert('Username Already Taken')</script>";
        } else {
            $query = "INSERT INTO user_base VALUES ('$username', '$password', '$email', '$name')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registration Successful')</script>";
            } 
            else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "')</script>";
            }
        }
    } else {
        echo "<script>alert('already registered " . mysqli_error($conn) . "')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <title>My LMS</title>
    </head>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: flex-end; /* Align form to the right */
}

form {
    background-color: #fff;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
}

h1 {
    color: #333;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

input[type="checkbox"] {
    margin-right: 6px;
}

label[for="agreed"] {
    display: inline-block;
    margin-bottom: 12px;
    color: #333;
}

    </style>
    <body>
        <h1>Vellore Institute of Technology <br> Andhra Pradesh </h1>
        <br>
        
        <form method="post" action="" autocomplete="off">
        <h3>Subscribe to Mail List</h3>
            <label for="email">e-mail : </label>
            <input type="email" name="email" id="email" value=""  required>
            <br>
            <label for="username">Username : </label>
            <input type="text" name="username" id="username" value="" required>
            <br>
            <label for="name">Name : </label>
            <input type="text" name="name" id="name" value=""  required>
            <br>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password" value=""  required>
            <br>
            <input type="checkbox" name="agreed" id="agreed" value="" required>
            <label for="agreed">I agree to receive mails from VIT-AP</label>
            <br>
            <button type="submit" name = "submit" >submit</button>
        </form>
    </body>
</html>