<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if (empty($username)) {
        $error = 'Please enter your username!';
    }elseif (empty($email)){
        $error = 'Please enter your name!';
    }elseif (empty($password1)){
        $error = 'Please enter your password!';
    }elseif (empty($password2)){
        $error = 'Please confirm your password!';
    }else{
        $db = mysqli_connect('localhost', 'root', '', 'iotlogin');

        $emailquery = "SELECT * FROM userregister WHERE email = '$email'";
        $emailresult = mysqli_query($db, $emailquery);
        $usernamequery = "SELECT * FROM userregister WHERE username = '$username'";
        $usernameresult = mysqli_query($db, $usernamequery);
        if (mysqli_num_rows($emailresult)>0){
            $error = 'Email already exists';
        }elseif(mysqli_num_rows($usernameresult)){
            $error = 'Username already exists';
        }elseif($password1 != $password2){
            $error = 'Password not same!';
        }else{
            $query = "INSERT INTO userregister (username,email,passwordc)VALUE('$username','$email','$password1')";
            if(mysqli_query($db,$query)){
                header('location:login.php');

            }else{
                $error = 'error creating account';
            }
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
    <title>Register</title>
</head>
<body>
    <form action="" method="post">
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email" required><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password1">Password</label><br>
        <input type="password" id="password1" name="password1" required><br>
        <label for="password2">Confirm Password</label><br>
        <input type="password" id="password2" name="password2" required><br>
        <input type="submit" value="submit">
    </form><br>
    <span><span>if u have account?</span><a href="login.php">Login?</a></span>
    <?php if (!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>