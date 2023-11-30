<?php
    include "include.php";
    session_start();
    $facultyID = $_SESSION['instructorID_var'];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $qrcode = $_POST['qrcodeResult'];
        $room = $_SESSION['room'];
        $section = $_SESSION['section_var'];
        $timeIn = $_SESSION['time_In'];
        $timeOut = $_SESSION['time_Out'];
        $date = $_SESSION['date_var'];
        
        $sql = "SELECT * FROM student_tbl WHERE StudentQR='$qrcode'";
        $result = $conn->query($sql);
    
        if ($result ->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $studentID = $row["studid"];
            $checkDuplicate = "SELECT * FROM attendance_tbl WHERE AttendanceDate = '$date' AND FacultyID = '$facultyID' AND studid = '$studentID' AND ClassSection = '$section' AND Room = '$room' AND TimeStart = '$timeIn' AND TimeEnd = '$timeOut'";
            $checkDuplicateQ = $conn->query($checkDuplicate);
            if ($checkDuplicateQ ->num_rows == 0) {  
                $queryQR = "INSERT INTO `attendance_tbl`(`AttendanceID`, `FacultyID` ,`studid`, `AttendanceDate`, `ClassSection`, `Room`, `TimeStart`, `TimeEnd`) VALUES ('[value-1]','$facultyID','$studentID','$date','$section','$room','$timeIn','$timeOut')";
                $resultInsert = $conn->query($queryQR);
                die(header('refresh: 0.1; url=scan.php').'<script type="text/javascript">alert("Student has attended.");</script>');
            } else {
                die(header('refresh: 0.1; url=scan.php').'<script type="text/javascript">alert("Student has already attended.");</script>');
            }
        } else { 
            die(header('refresh: 0.1; url=scan.php').'<script type="text/javascript">alert("Student does not exist.");</script>');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>

html {
    animation: fade-in 1s forwards;
}

.mainContainer {
    position:absolute;
    margin-top: 60px;
    margin-left: 31%;
    animation: expand .8s ease forwards;
}

.container1{
    width: 640px;
    height: 100px;
    background: none;
    position: absolute;
    top: 3%;
    left: 27%;
    border-style: solid;
    border-color: rgb(208, 17, 43);
    text-align: center;
    background-color: rgba(255, 255, 255, 0.732);
    border-radius: 10px;
    font-size: 25px;
}

#preview {
    width: 640px;
    height: 400px;
}
.endDiv {
    position: absolute;
    margin-top: 70px;
    margin-left: 205px;
}

.container{
    width: 640px;
    height: 400px;
    background: none;
    position: absolute;
    top: 15%;
    left: 27%;
    border-style: solid;
    border-color: rgb(208, 17, 43);
    text-align: center;
 }
 .col-md-6 label{
    color: black;
    font-size: 40px;
 }

.col-md-6 input{
    background-color: rgba(255, 255, 255, 0.732);
    border: none;
    border-radius: 10px;
    outline: none;
    text-align: center;
    margin-top: none;
    width: 100%;
    line-height: 37px;
    font-family: "Arial", sans-serif;
    font-size: 35px;
    color: rgb(0, 0, 0);
    height: 35px;
    width: 600px;
    filter: drop-shadow(2px 2px 2px #222);
}
 .header h2{
    z-index: 20;
    top: 20%;
    left: 27%;
}

 body {
    margin-left: -35px;
    padding: 0;
    font-family: 'arial', arial;
    box-sizing: border-box;
    background-image: url(BSUbackground.png);
    background-repeat: no-repeat;
    background-size: cover;
}

.pass{
    width: 230px;
    height: 40px;
    background:rgb(255, 255, 255);
    border-radius: 10px;
    margin: 60px auto;
    text-align: center;
    filter: drop-shadow(2px 2px 2px #222);
    font-size: 16px;
}

.end{
    width: 230px;
    height: 40px;
    margin: 60px auto;
    display: block;
    font-family: "Arial", sans-serif;
    font-size: 16px;
    border: none;
    color: #E90808;
    border-radius: 4px;
    transition: 0.3s all ease;
    font-size: 20px;
    outline: none;
    border: 3px solid #E90808;
    z-index: 1;
}

.end:hover {
    background-color: #E90808;
    color: #fff;
    cursor:pointer
}

.attendBtn{
    position: absolute;
    margin-left: 32%;
    width: 230px;
    height: 40px;
    display: block;
    font-family: "Arial", sans-serif;
    margin-top: 5px;
    border: none;
    color: #E90808;
    border-radius: 4px;
    transition: 0.3s all ease;
    font-size: 20px;
    outline: none;
    border: 3px solid #E90808;
    z-index: 1;
}

.attendBtn:hover {
    background-color: #E90808;
    color: #fff;
    cursor:pointer
}

.pass {
    float: inline-start;
    margin-left: 65px;
}
.end{
    float: inline-end;
    margin-right: 65px;
}

.underline-link {
    color: #E90808;
    position: absolute;
    margin-top: 35px;
    margin-left: -57px;
}

.underline-link:hover {
    color: white;
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <title>Student Attendance</title>
</head>
<body>
<form action="" method="post">
    <div class="mainContainer">
    <div class="container1">
        <h2>SCAN QR CODE</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="640" height="480" autoplay="autoplay" class="active" style="transform: scaleX(-1); z-index: 1;"></video>
            </div>
            <div class="col-md-6">
                <input type="text" name="qrcodeResult" id="qrcodeResult" readonly class="form-control">
        </div>
            <input class="attendBtn" type="submit" name = "Attend" value="Attend">
            <p><a href="registerQR.php" class="underline-link">Register QR Code</a>.</p>
        </div>
</form>
<div class ="endDiv">
    <input class="end" type="button" value="End Attendance" onclick="window.location.href='home.php';">
</div>
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            }else{
                alert('No Camera Found!');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c){
            document.getElementById('qrcodeResult').value=c;
        });
    </script>
    
</body>
</html>