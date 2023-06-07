<?php
$login = false;
$err = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // $sql = "select * from users where username='$username' AND password='$password' ";
    $sql = "select * from users where username='$username' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['password'])){
        $login=true;
        session_start();
        $_SESSION['login']= true;
        $_SESSION['username']= $username;
        header("location:index.php");
            }
            else
            {
                $err=true;
            }   
        }
    }
    else
    {
        $err=true;
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($login){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are logged in.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($err){
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Invalid credentials Try again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <div class="container my-4">
        <h1 class="text-center">Login with your credentials....</h1>
        <form action="login.php" method="post">
    <div class="form-group">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" >
    </div>
    <div class="form-group">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    </div><br>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>