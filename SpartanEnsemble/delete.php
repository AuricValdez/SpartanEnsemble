<?php
 if (isset($_GET['AttendanceID'])) {
    include "include.php";
    $id = $_GET['AttendanceID'];
    $sql = "DELETE FROM attendance_tbl WHERE AttendanceID ='$id'";
    mysqli_query($conn,$sql);
    die(header('refresh: 0.1; url=viewAttendance.php').'<script type="text/javascript">alert("Student removed fron attendance.");</script>');
 }
?>