<?php
function opDB()
{
    $dbms='mysql';     //類型
    $host='localhost'; //主機名
    $dbName='dbms_project';    //DB名
    $user='root';      //用戶
    $pass='';          //密碼
   
    $conn = new mysqli($host,$user,$pass,$dbName) or die("Connect failed: %s\n". $conn ->error );
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error."<br>");
    } 
    else {
        // echo ("連接資料庫成功<br>");
        mysqli_query($conn, "SET NAMES 'utf8'");
    }
    
    return $conn;
    
}
function CloseCon($conn)
{
    $conn -> close();
    // echo ("<br>關掉了<br>");
}
?>
