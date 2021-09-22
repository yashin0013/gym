<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gym";

    // Create connection 
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Die if connection was not successful
    if(!$conn){
        die("Sorry We failed to connect: ". mysqli_connect_error());
        }
        $name = $_POST["name"];
        $age = $_POST["age"];
        $weight = $_POST["weight"];
        $mobile = $_POST["mobile"];
        $email = $_POST["email"];

         // check wheater this username exists. 
    $existSql = "SELECT * FROM `users` WHERE email = '$email' ";
    $result = mysqli_query($conn, $existSql);
     $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
          // $exists = true;
     $showError = "This Email is already exists in our server";

      }
    else {
    // Sql query to be executed
    $sql = "INSERT INTO `users` ( `id`,`name`, `age`, `weight`, `mobile`, `email`) VALUES (NULL, '$name', '$age', '$weight', '$mobile', '$email' )";
    $result = mysqli_query($conn, $sql);
    if ($result){
        $showAlert = true;
    }else {
        echo "no";
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
    <title>Fitness Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
    body {
        font-family: 'Balsamiq Sans', cursive;
        color: white;
        margin: 0%;
        padding: 0%;
        background: url(man.jpg)
    }

    .left {
        /* border: 2px solid red; */
        display: inline-block;
        position: absolute;
        left: 44px;
        top: 32px;
    }

    .mid {
        display: block;
        width: 43%;
        margin: 32px auto;
        /* border: 2px solid rgb(27, 196, 64); */
    }

    .right {
        position: absolute;
        right: 34px;
        top: 32px;
        /* border: 2px solid rgb(89, 0, 255); */
        display: inline-block;
    }

    .navbar,
    li {
        display: inline-block;
    }

    .navbar,
    li a {
        color: white;
        text-decoration: none;
        padding: 15px;
        font-size: 20px;

    }

    .navbar,
    li a:hover {
        color: rgb(109, 185, 236);
        text-decoration: underline;
    }

    .left,
    img {
        width: 103px;

    }

    .btn {
        margin: 0px 8px;
        color: black;
        background-color: rgb(238, 238, 238);
        padding: 4px 12px;
        font-size: 15px;
        border: 2px solid grey;
        border-radius: 10px;
        cursor: pointer;
        font-family: 'Balsamiq Sans', cursive;
    }

    .btn:hover {
        background-color: rgb(196, 245, 122);
    }

    .container {
        /* border: 2px solid greenyellow; */
        padding: 25px 40px;
        margin: 30px 40px;
        width: 30%;
        border-radius: 9px;
    }

    .formgroup input {
        /* text-align: center; */
        margin: 6px;
        display: block;
        width: 220px;
        padding: 6px;
        border: 2px solid rgb(51, 243, 93);
        border-radius: 9px;
        font-family: 'Balsamiq Sans', cursive;
    }

    .container h2 {
        color: rgb(2, 7, 31)
    }
    </style>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Mobile Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-dark">
                    <p> Call Now - 7357250128</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <header class="header">
        <div class="left">
            <!-- Left box for Logo -->
            <img src="logo.jpg" alt="">
        </div>
        <div class="mid">
            <!-- Mid box for navbaar -->
            <ul class="navbar">
                <li> <a href="/gym/index.php">Home</a> </li>
                <li><a href="https://www.calculator.net/fitness-and-health-calculator.html">Fitness Calculator</a></li>
                <li><a href="/gym/aboutus.php">About us</a></li>
                <li><a href="/gym/contactus.php">Contact us</a></li>
            </ul>
        </div>
        <div class="right">
            <!-- Right box for button -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Call Now
            </button>
        </div>
    </header>

    <div class="container">
        <h2>Join the Best GYM of Delhi</h2>
        <?php
     if($showAlert){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>  Your have submitted your details successfully. We will contact you as soon as posible.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                   }
                if($showError){
                echo'
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> '. $showError.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                }
            ?>
           
        <form action="/gym/index.php" method="post">
            <div class="formgroup">
                <input type="text" maxlength="21" name="name" placeholder="Enter Your Name">
            </div>
            <div class="formgroup">
                <input type="text" maxlength="3" name="age" placeholder="Enter Your Age">
            </div>
            <div class="formgroup">
                <input type="text" maxlength="3" name="weight" placeholder="Enter Your Weight">
            </div>
            <div class="formgroup">
                <input type="mobile" maxlength="10" name="mobile" placeholder="Enter Your Mobile Number">
            </div>
            <div class="formgroup">
                <input type="email" name="email" placeholder="Enter Your Email">
            </div>
            <button class="btn">Submit</button>
        </form>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>

</html>