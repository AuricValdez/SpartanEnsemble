<?php
    include "include.php";
    session_start();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM faculty_tbl WHERE FacultyUsername = '$username' AND FacultyPassword = '$password';";
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['instructorID_var'] = $row["FacultyID"];
            header("location: home.php");
        } else {
            die(header('refresh: 0.1; url=login.php').'<script type="text/javascript">alert("Invalid Credentials. Try Again.");</script>');
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <style>
    /*#E90808*/

html {
    animation: fade-in 1s forwards;
}

body {
    margin-left: -35px;
    padding: 0;
    font-family: 'arial', arial;
    box-sizing: border-box;
    background-image: url(BSUbackground.png);
    background-repeat: no-repeat;
    background-size: cover;
    animation: fade-in 1s forwards;
}

.roomTitle {
    font-size: 25px;
}

.container {
    width: 447px;
    height: 581px;
    background: url(img/LoginD.png);
    position: absolute;
    top: 51%;
    left: 48%;
    transform: translate(-50%,-50%);
    color: rgb(255, 0, 0);
    text-align: center;    
}


.textBoxes{
    width: 260px;
    height: 40px;
    background:rgb(255, 255, 255);
    border-radius: 10px;
    margin: 10px auto;
    filter: drop-shadow(2px 2px 2px #222);
    
}

.textBoxes input {
    background: none;
    border: none;
    outline: none;
    text-align: center;
    width: 90%;
    line-height: 40px;
    font-family: "Arial", sans-serif;
    font-size: 20px;
}

.loginBtn {
    width: 230px;
    height: 50px;
    border: none;
    color: #E90808;
    border-radius: 4px;
    transition: 0.3s all ease;
    font-size: 20px;
    outline: none;
    border: 3px solid #E90808;
    z-index: 1;
}

.loginBtn:hover {
    background-color: #E90808;
    color: #fff;
    cursor:pointer
}

.menu {
    position: fixed;
    margin-left: 37%;
    margin-top: 6%;
    width: 500px;
    height: 1000px;
    background-image: url(menuHomeHome.png);
    background-repeat: no-repeat;   
    animation: expand .8s ease forwards;
}


.logo {
    margin-top: 2%;
    margin-left: 47%;
    position: absolute;
    width: 175px;
    animation: expand .8s ease forwards;
}

@keyframes fade-in {
    from {
        background-color: rgba(#000, 0.25);
        opacity: 0;
    }

    to {
        background-color: rgba(#000, 0);
        opacity: 1;
    }
}

@keyframes expand {
  0% {
    transform: translateX(1400px);
  }
  100% {
    transform: translateX(0px);
  }
}
    </style>
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>
        <div class="menu">
            <div class="container">
                <h2 class = "roomTitle">Room Attendance <br>Management System</h2>
        <form action="" method="post">
            <div class="textBoxes">
                <input type="text" name="username" placeholder="Full Name" id="username" required>
            </div>
            <div class="textBoxes">
                <input type="password" name="password" placeholder="Password" id="password" required>
            </div>
            <input type="checkbox" onclick="showPassword()">Show Password
            <br>
            <br>
            <br>
            <input class="loginBtn" type="submit" name="" value="Log In">   
        </form>
            </div>
        </div>
        <img class="logo" src="BSU.png" alt ="BSU Logo">
        <script>
            function showPassword() {
              var x = document.getElementById("password");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
        </script>
    </body>
</html>