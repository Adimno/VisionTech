<?php

@include 'admin/config.php';

session_start();

if (isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    $select = " SELECT * FROM user_form WHERE email = '$email' AND password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0){
       
        $row = mysqli_fetch_array($result);

        if ($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin/admin_index.php');

        }elseif ($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            header('location:index.php');
        }
    } else {
        $error[] = 'incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/logos/icon.png">
    <title>Login Form</title>

    <!-- css link  -->
    <link rel="stylesheet" href="account.css">

</head>
<body>
    <!-- login form -->
    <div class="form-container">
        <form action="" method="post">
            <h3>login</h3>
                <?php
                    if (isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">'.$error.'</span>';
                        }
                    }
                ?>
            <input type="text" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">

            <!-- button -->
            <input type="submit" name="submit" value="login now" class="form-btn"> 
            <p>don't have an account? <a href="login_user.php">register now</a></p>
        </form>
    </div>
<!-- end login form -->

</body>
</html>