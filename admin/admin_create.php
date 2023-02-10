<?php

@include 'config.php';



if (!isset($_SESSION['admin_name'])){
    header('location:../guest_index.html');
}

if (isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    $select = " SELECT * FROM user_form WHERE email = '$email' AND password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0){
        echo '<script language="javascript">';
        echo 'alert("User already exist")';
        echo '</script>';
    } else {
        if($pass != $cpass){
            $error[] = 'password not matched!';
        } else {
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES ('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
         
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>

    <!-- css link  -->
    <link rel="stylesheet" href="account.css">

</head>
<body>
    <!-- registration form -->
    <div class="form-container">
        <form action="" method="post">
            <h3>Register ADMIN</h3>
                <?php
                    if (isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">'.$error.'</span>';
                        }
                    }
                ?>
            <input type="text" name="name" required placeholder="Enter your name"> <br> 
            <input type="text" name="email" required placeholder="Enter your email"> <br>
            <input type="password" name="password" required placeholder="Enter your password"> <br>
            <input type="password" name="cpassword" required placeholder="Confirm your password"><br>

            <!-- type of users -->
            <select name="user_type">
            <option value="admin">Admin</option>
               
            </select>
            <input type="submit" name="submit" value="register" class="form-btn"> 
          
        </form>
    </div>

</body>
</html>