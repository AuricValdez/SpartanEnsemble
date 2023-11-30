<?php
    include "include.php";
    session_start();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $instructor = $_SESSION['session_variable'];
        $password = $_SESSION['endPassword_var'];    
        $passwordDB = "SELECT FacultyPassword FROM faculty_tbl WHERE FacultyID ='$instructor'";
    
        if ($password == $passwordDB) {
            header("location: home.php");
        } else {
            echo $instructor;
            echo $password;
            echo $passwordDB;
        }
    }
?>