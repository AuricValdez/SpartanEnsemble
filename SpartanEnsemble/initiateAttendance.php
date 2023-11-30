<?php
    session_start();
    include "include.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["RoomTb"])) {
            $_SESSION['room'] = $_POST['RoomTb'];
        }
        if (isset($_POST["section"])) {
            $_SESSION['section_var'] = $_POST['section'];
        }
        if (isset($_POST["timeIn"])) {
            $_SESSION['time_In'] = $_POST['timeIn'];
        }
        if (isset($_POST["timeOut"])) {
            $_SESSION['time_Out'] = $_POST['timeOut'];
        }
        if (isset($_POST["date"])) {
            $_SESSION['date_var'] = $_POST['date'];
        }
        header("location: scan.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
html {
    animation: fade-in 1s forwards;
}
body{
    background: url(BSUbackground.png);
    background-repeat: no-repeat;
    background-size: cover;

}
.rectangle{
    height: 58px;
    width: 724px;
    background-color: rgb(208, 17, 43);
}

.titleContainer {
    background-image: url(TitleInitiateRoom.png);
    width: 500px;
    height: 100%;
}

.container{
   margin-top: 75px;
   margin-left: -35px;
   position: absolute;
   width: 726px;
   height: 450px;
   background-color: rgba(255, 255, 255, 0.732);
   position: absolute;
   top: 20%;
   left: 29%;
    border-style: solid;
    border-color: rgb(208, 17, 43);
   text-align: center;
   animation: expand .8s ease forwards;
}
.logo{
    margin-top: 95px;
    margin-left: 45%;
    position: absolute;
    width: 175px;
    top: 7%;
    text-align: center;
    filter: drop-shadow(5px 5px 5px #222);
    animation: expand .8s ease forwards;
}

.homeBtn {
    width: 33px;
    height: 30px;
    margin-top: 25px;
    margin-right: 25px;
    background-color: transparent;
    position: absolute;
    top: 10px;
    right: 10px;
    transition: ease-in-out 0.1s;
    border: none;
    background-repeat: no-repeat;
    background: url(home.png);
}

.homeBtn:hover {
    width: 34px;
    background-repeat: no-repeat;
    background: url(homeHover.png);
}

.homeBtn:focus {
    outline: none;
}

.exitBtn{
    margin-top: 2%;
    margin-left: 71.5%;
    position: absolute;
    width: 30px;
    top: 18%;
    text-align: center;
    filter: drop-shadow(5px 5px 5px #222);
}
.container h2{
    margin-top: 30px;
    font-family: "Arial", sans-serif;
    color: rgb(208, 17, 43);
}

.menubar {
    background-color: rgb(255, 255, 255);
    width: 100%;
    height: 100px;
    position: relative;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
}

.tboxes {
    width: 260px;
    height: 40px;
    background:rgb(255, 255, 255);
    border-radius: 10px;
    margin: 10px auto;
    margin-top: 44px;
    filter: drop-shadow(2px 2px 2px #222);
}

.sectionTbox {
    margin-top: 20px;
}
.tboxes input {
    background: none;
    border: none;
    outline: none;
    text-align: center;
    width: 90%;
    line-height: 40px;
    font-family: "Arial", sans-serif;
    font-size: 20px;
}
.graduate{
    margin-top: 11.75%;
    margin-left: 43%;
    position: absolute;
    width: 30px;
    top: 18%;
    text-align: center;
    filter: drop-shadow(5px 5px 5px #222);
}

.time{
    margin-top: 135px;
    margin-left: -3%;
    position: absolute;
    width: 45px;
    top: 18%;
    text-align: center;
    filter: drop-shadow(5px 5px 5px #222);
    float: inline-end;
}

.date {
    text-align: center;
}

.date1{
    width: 250px;
    height: 35px;
    background:rgb(255, 255, 255);
    border-radius: 10px;
    margin: 10px auto;
    float: inline-start;
    filter: drop-shadow(2px 2px 2px #222);
    margin-left: 10%;
}

.date2{
    width: 250px;
    height: 35px;
    background:rgb(255, 255, 255);
    border-radius: 10px;
    margin: 10px auto;
    float: inline-end;
    filter: drop-shadow(2px 2px 2px #222);
    margin-right: 10%;
}

.date1 input{
    background: none;
    border: none;
    outline: none;
    text-align: center;
    width: 90%;
    line-height: 40px;
    font-family: "Arial", sans-serif;
    font-size: 20px;
}
.date2 input{
    background: none;
    border: none;
    outline: none;
    text-align: center;
    width: 90%;
    line-height: 40px;
    font-family: "Arial", sans-serif;
    font-size: 20px;
}
.date{
    width: 250px;
    height: 35px;
    background:rgb(255, 255, 255);
    border-radius: 10px;
    margin: 10px auto;
    filter: drop-shadow(2px 2px 2px #222);
    margin-left: 0%;
    border: none;
}

.initiate{
    width: 230px;
    height: 50px;
    display: block;
    font-family: "Arial", sans-serif;
    font-size: 16px;
    margin-top: 40px;
    margin-left: 250px;
    position: absolute;
    border: none;
    border: none;
    color: #E90808;
    border-radius: 4px;
    transition: 0.3s all ease;
    font-size: 20px;
    outline: none;
    border: 3px solid #E90808;
    z-index: 1;
}

.initiate:hover {
    background-color: #E90808;
    color: #fff;
    cursor:pointer
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BatStateU Room Attendance System</title>
    <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
    <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="menubar">
        <div class="titleContainer"></div>
        <button onclick="window.location.href='home.php';" class="homeBtn"></button>
    </div>
    <div class="container">
        <div class="rectangle"></div>
        <form action="" method="post">
            <div class="tboxes">
                <input type="text" name="RoomTb" placeholder="Room" id="RoomTb" required>
            </div>
            <div class="tboxes sectionTbox">
                <input type="text" name="section" id="section" placeholder="Section" required>
            </div>
            <div class="date1">
                <input type="text" name="timeIn" id="timeIn" placeholder="Time In (24-hour)" required>
            </div>
            <div class="date2">
                <input type="text" name="timeOut" id="timeOut" placeholder="Time Out (24-hour)" required>
            </div>
            <img class="time" src="time.png" alt="">
            <div>
                <input type="date" class="date" name="date" id="date" required>
            </div>
            <div>
                <input class="initiate" type="submit" name = "initiate" value="Initiate">
            </div>
        </form>
            </div>
                <img class="logo" src="BSU.png" alt="">
            <div>
    </div>
</body>
</html>