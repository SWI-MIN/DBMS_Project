<?php
session_start();
if(isset($_SESSION['userData'])) {
    include 'db_connect.php';
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
    echo "<script type='text/javascript'>";
    echo "window.location.href='查詢&退選.php'";
    echo "</script>"; 

}else {
    header("Location: ./login_index.php"); 
  }
?>