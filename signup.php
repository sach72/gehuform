<?php
$showAlert = false;
$err = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmpass = $_POST["confirmpass"];
    $existsql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existsql);
    $numExistrows = mysqli_num_rows($result);
    if($numExistrows>0)
    {
        $err = "Username already exists";
    }
    else{
    if(($password==$confirmpass)){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ( '$username', '$hash', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    if($result){
        $showAlert=true;
    }
    }
    else
    {
        $err="Password did not matched";
    }
}
}
?>
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success! </strong> Your account is created continue to login.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($err){
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error! </strong>'.$err.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container my-4">
        <h1 class="text-center">Signup to continue...</h1>
        <form action="signup.php" method="post">
    <div class="form-group">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" >
    </div>
    <div class="form-group">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
    <label for="confirmpass" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="confirmpass" name="confirmpass">
    <div id="emailHelp" class="form-text">Make sure to enter the same password.</div>
    </div><br>
    <button type="submit" class="btn btn-primary">Signup</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>