<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $log_username = $_POST['log_username'];
    $log_password = $_POST['log_password'];

    if(empty($log_username)){
        $error = "pls enter username";
    }elseif(empty($log_password)){
        $error = "pls enter password";
    }else{
        $conn = mysqli_connect('localhost', 'root', '', 'iotlogin');
        $ruser = mysqli_real_escape_string($conn, $log_username);
        $rpass = mysqli_real_escape_string($conn, $log_password);

        $log_query = "SELECT * FROM userregister WHERE username = '$ruser' AND passwordc='$rpass'";
        $log_result = mysqli_query($conn, $log_query);
        if (mysqli_num_rows($log_result) > 0) {
            session_start();
            $_SESSION['log_username'] = $ruser;
            header('location: homepage.php');
        }else{
            echo ('error!');
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
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="log_username" name="log_username" required><br>
        <label for="password1">Password:</label><br>
        <input type="password" id="log_password" name="log_password" required><br>
        <input type="submit" value="submit">
    </form>
</body>
</html>