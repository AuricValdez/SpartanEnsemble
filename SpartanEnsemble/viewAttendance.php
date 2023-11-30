<?php
    include "include.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dateCondition = $_POST['attendanceDate'];
        $roomCondition = $_POST['room'];
        $sectionCondition = $_POST['classSection'];

        session_start();
        $facultyID = $_SESSION['instructorID_var'];
        $queryStudents = "SELECT * FROM ( SELECT t1.*, CONCAT(t2.firstname,' ',t2.lastname) AS StudentName FROM attendance_tbl t1 INNER JOIN tb_studentinfo t2 ON t1.studid = t2.studid) t3 WHERE FacultyID = '$facultyID' AND Room = '$roomCondition' AND AttendanceDate = '$dateCondition' AND ClassSection = '$sectionCondition'";
        $students = mysqli_query($conn,$queryStudents);

        $queryAll = "SELECT * FROM attendance_tbl";
        $resultAll = mysqli_query($conn,$queryAll);

        $queryTimeStart = "SELECT TimeStart FROM attendance_tbl WHERE AttendanceDate = '$dateCondition' AND ROOM = '$roomCondition' AND ClassSection = '$sectionCondition';";
        $tempTimeStart = mysqli_query($conn,$queryTimeStart);

        if ($tempTimeStart->num_rows > 0) {
            while($row = $tempTimeStart->fetch_assoc()) {
                $timeStart = $row["TimeStart"];
                break;
            }
        }
    
        $queryTimeEnd = "SELECT TimeEnd FROM attendance_tbl WHERE AttendanceDate = '$dateCondition' AND ROOM = '$roomCondition' AND ClassSection = '$sectionCondition';";
        $tempTimeEnd = mysqli_query($conn,$queryTimeEnd);

        if ($tempTimeEnd->num_rows > 0) {
            while($row = $tempTimeEnd->fetch_assoc()) {
                $timeEnd = $row["TimeEnd"];
                break;
            }
        }
    

    }

    $queryDate = "SELECT DISTINCT AttendanceDate FROM attendance_tbl ORDER BY AttendanceDate ASC";
    $attendanceDate = mysqli_query($conn,$queryDate);
    
    $queryRoom = "SELECT DISTINCT Room FROM attendance_tbl ORDER BY Room ASC";
    $room = mysqli_query($conn,$queryRoom);
    
    $querySection = "SELECT DISTINCT ClassSection FROM attendance_tbl ORDER BY Room ASC";
    $section= mysqli_query($conn,$querySection);
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
    margin: 0;
    padding: 0;
    font-family: 'arial', arial;
    box-sizing: border-box;
    background-image: url(BSUbackground.png);
    background-repeat: no-repeat;
    background-size: cover;
}

.menubar {
    background-color: rgb(255, 255, 255);
    width: 100%;
    height: 100px;
    position: relative;
    margin-top: 0px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
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

.container {
    animation: expand .8s ease forwards;
}

.titleContainer {
    background-image: url(TitleHome.png);
    width: 500px;
    height: 100%;
}

.titleContainerView {
    background-image: url(TitleViewAttendanceLogs.png);
    width: 500px;
    height: 100%;
}

.logo {
    margin-top: 2%;
    margin-left: 45%;
    position: absolute;
    width: 175px;
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

.readonlyRow {
    font-size: 12px;
}

.delBtn {
    width: 200px;
}
    </style>
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>View Attendance</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
    <div class="menubar">
            <div class="titleContainerView"></div>
            <button onclick="window.location.href='home.php';" class="homeBtn"></button>
        </div>
        <form action="" method="post">
        <div class ="container">
            <div class="menuViewAttendance">
                <div class="containerTable">
                    <div class="row mt-5">
                        <div class="col">
                            <div class="card">  
                                <div class="card-header">
                                Attendance Date:     <input type="date" list="attendanceDate" autocomplete="off" id="pcategory" name="attendanceDate" class="attendanceDate" required>
                                    <datalist id="attendanceDate">
                                        <?php while($row = mysqli_fetch_array($attendanceDate)) { ?>
                                        <option value="<?php echo $row['AttendanceDate']; ?>"><?php echo $row['AttendanceDate']; ?></option>
                                        <?php } ?>
                                     </datalist>
                                &nbsp&nbsp&nbsp&nbspRoom:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" list="room" autocomplete="off" id="pcategory" name="room" required>
                                    <datalist id="room">
                                        <?php while($row = mysqli_fetch_array($room)) { ?>
                                        <option value="<?php echo $row['Room']; ?>"><?php echo $row['Room']; ?></option>
                                        <?php } ?>
                                     </datalist>         
                                &nbsp&nbsp&nbsp&nbspClass Section:     <input type="text" list="classSection" autocomplete="off" id="pcategory" name="classSection" required>
                                    <datalist id="classSection">
                                        <?php while($row = mysqli_fetch_array($section)) { ?>
                                        <option value="<?php echo $row['ClassSection']; ?>"><?php echo $row['ClassSection']; ?></option>
                                        <?php } ?>
                                     </datalist>
                                <button  name="search" action ="" method="post" type="submit" class="btn btn-success float-right">Search</button>
                                </div>
                                <div class="card-header readonlyRow">
                                    Attendance Date: <input type="text" id="pcategory" name="timeEnd" value = "<?php echo @$dateCondition;?>">
                                    Room: <input type="text" id="pcategory" name="timeStart" value = "<?php echo @$roomCondition;?>">
                                    Class Section: <input type="text" id="pcategory" name="timeEnd" value = "<?php echo @$sectionCondition;?>">
                                    Time Start: <input type="text" id="pcategory" name="timeStart" value = "<?php echo @$timeStart;?>">
                                    Time End: <input type="text" id="pcategory" name="timeEnd" value = "<?php echo @$timeEnd;?>">
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered text-center">  
                                        <tr class="bg-dark text-white">
                                            <td>Students who attended:</td>
                                            <td>Unattend</td>
                                        </tr>
                                        <tr>
                                        <?php
                                            while($row = mysqli_fetch_assoc($students)) {
                                        ?>      
                                            <td><?php echo $row['StudentName'];?></td>
                                            <td class="delBtn">
                                                <a href="delete.php?AttendanceID=<?php echo $row['AttendanceID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Unattend</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </divl>
                </div>
            </div>
        </form>
        </div>
    </body>
</html>