<?php
    header("Content-type: text/html; charset=utf-8");
    $id = $_POST['id'];
    $password = $_POST['password'];

    $dbms='mysql';     //数据库类型
    $host='localhost'; //数据库主机名
    $dbName='phptest';    //使用的数据库
    $user='root';      //数据库连接用户名
    $pass='';          //对应的密码
    $dsn="$dbms:host=$host;dbname=$dbName";
    $conn = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($id == ''){
        echo '<script>alert("請輸入使用者名稱!");history.go(-1);</script>';
        exit(0);
    }
    if ($password == ''){
        echo '<script>alert("請輸入密碼!");history.go(-1);</script>';
        exit(0);
    }
    $sql = "SELECT * FROM idpassword WHERE id = '$_POST[id]' AND password = '$_POST[password]'";
    $result = $conn->query($sql);
    $number = $result->fetch();//mysqli_num_rows($result);
    if ($number) {
        echo '<script>window.location="welcome.html";</script>';
    } else {
        echo '<script>alert("使用者名稱或密碼錯誤!");history.go(-1);</script>';
    }

?>


