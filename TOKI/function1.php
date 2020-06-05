<?php
function opDB()
{
    $dbms='mysql';     //類型
    $host='localhost'; //主機名
    $dbName='dbms_project';    //DB名
    $user='root';      //用戶
    $pass='';          //密碼
    $dsn="$dbms:host=$host;dbname=$dbName";
    $conn = new mysqli($host,$user,$pass,$dbName);
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error."<br>");
    } 
    else {
        // echo ("連接資料庫成功<br>");
    }
    
    return $conn;
    
}
function CloseCon($conn)
{
    $conn -> close();
    // echo ("<br>關掉了<br>");
}

?>


