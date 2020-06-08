<?php
session_start();
if(isset($_SESSION['userData'])) {
    include 'db_connect.php';
    $conn = opDB();
    $id = $_SESSION['userData'];
    $course = $_GET['value'];

    $sql_1 ="UPDATE courseinfo SET coursestu = (coursestu -1) WHERE courseid = \"$course\";";
    $sql_2 ="DELETE FROM choosing WHERE courseid = \"$course\" AND stuid = \"$id\"";
    if ($conn->query($sql_2)) {
        if ($conn->query($sql_1)) { 
            echo "<script type='text/javascript'>";
            echo "window.location.href='查詢&退選.php'";
            echo "</script>"; 
        } else {
            echo "人數更新 Error"."<br>"; } 

    } else {
        echo "DELETE Error"."<br>";
        if($conn->query($sql_1)){} else { echo "人數更新 Error"."<br>"; }
    } 

} else {
    header("Location: ./login_index.php"); 
  }
?>