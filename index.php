<?php
// $nameErr = $emailErr = $genderErr = "";
// $Name = $email = $Gender = $Other  = "";
$insert = false;
if(isset($_POST['Name'])){
//set connecton variable
$server = "localhost";
$username = "root";
$password = "";
//create connection for database
$con = mysqli_connect($server, $username, $password);
//check for connection success
if(!$con){
    die("connection to this database failed due to".mysqli_connect_error());
}
// echo "Success connecting to the database";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (empty($_POST["Name"])) {
//     $nameErr = "Name is required";
//     } else {
//     $name = test_input($_POST["Name"]);
//       // check if name only contains letters and whitespace
//     if (!preg_match("/^[a-zA-Z-' ]*$/",$Name)) {
//         $nameErr = "Only letters and white space allowed";
//     }

//collect post variables
$Name = $_POST['Name'];
$Age = $_POST['Age'];
$Gender = $_POST['Gender'];
$Email = $_POST['Email'];
$Phonenumber = $_POST['Phonenumber'];
$Other = $_POST['Other'];
$sql = "INSERT INTO  gehu_dashboard.trip(Name,Age,Gender,Email,Phonenumber,other,currentdate) VALUES 
('$Name','$Age','$Gender','$Email','$Phonenumber','$Other',current_timestamp());";
//echo $sql;

//execute the query
if($con->query($sql)==true){
    // echo"Successfully inserted";

    //flag for successful insert
    $insert=true;
}
else{
    echo "Error : $sql <br> $con->error";
}
// test input data(manual)
// function test_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }
// }

//closing the connection after the insertion is done to our database
$con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pangolin&family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="bg" src="gehu btl.jpg" alt="gehu btl">
    <div class="container">
    <h1>Welcome to Gehu Travel Website</h1>
    <p>Enter your details to confirm your identity in college DataBase.</p>
    <?php
    if($insert==true){
    echo "<p class='submitmsg'>Thanks for submitting your form. We are happy to see you!</p>";
    }
    ?>
    <form action="index.php" method="post">
        <input type="text" name="Name" id="name" placeholder="Enter your name" require>
        <input type="text" name="Age" id="age" placeholder="Enter your age" require>
        <input type="text" name="Gender" id="gender" placeholder="Enter your gender" require>
        <input type="email" name="Email" id="email" placeholder="Enter your email address" require>
        <input type="phone" name="Phonenumber" id="phone" placeholder="Enter your Phone number" require>
        <textarea name="Other" id="desc" cols="20" rows="10" placeholder="Enter your description">
        </textarea>
        <button class="btn">Submit</button>
        <br>
        <button class="btn1"><a href="http://localhost/phpmyadmin/index.php">Reset</a></button>
    </form>
    </div>
    <script src="index.js"></script>
</body>
</html>