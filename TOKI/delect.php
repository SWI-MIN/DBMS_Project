<?php
session_start();
include 'function1.php';
$conn = opDB();
$id = $_SESSION['userData'];
echo $id;
echo $_GET['value'];
$course = $_GET['value'];
$sql_1 ="UPDATE courseinfo SET coursestu = (coursestu -1) WHERE courseid = \"$course\";";
$sql_2 ="DELETE FROM choosing WHERE courseid = \"$course\" AND stuid = \"$id\"";
if ($conn->query($sql_1)) {           // query() 判斷資料庫查詢是否成功，if 成功回傳 true，else 回傳 false
    // echo "New Students successfully";
    // echo '<br><br>';
} else {
    echo "Error";
} 
if ($conn->query($sql_2)) {           // query() 判斷資料庫查詢是否成功，if 成功回傳 true，else 回傳 false
    // echo "New Students successfully";
    // echo '<br><br>';
} else {
    echo "Error";
} 
header("Location: http://localhost/remove.php"); 

?>