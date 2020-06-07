<?php
function PDOopDB()
{
    $dbms='mysql';     //数据库类型
    $host='localhost'; //数据库主机名
    $dbName='dbms_project';    //使用的数据库
    $user='root';      //数据库连接用户名
    $pass='';          //对应的密码
    $dsn="$dbms:host=$host;dbname=$dbName";
    $conn = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
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


