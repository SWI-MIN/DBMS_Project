<?php
    header("Content-type: text/html; charset=utf-8");//頁面編碼
    // error_reporting(E_ALL^E_NOTICE^E_WARNING);//隐藏报错信息
    session_start();                          //儲存登入行為
    

    $dbms='mysql';     //数据库类型
    $host='localhost'; //数据库主机名
    $dbName='dbms_project';    //使用的数据库
    $user='root';      //数据库连接用户名
    $pass='';          //对应的密码
    $dsn="$dbms:host=$host;dbname=$dbName";
    

    if(isset($_POST["login"]))  {
        $id = $_POST['id'];   
        $password = $_POST['password'];     

        if ($id == '' || $password == ''){
            echo '<script>alert("學號 AND 密碼 不能為空!!");history.go(-1);</script>';
            //exit(0);
        } else {
            $conn = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM students WHERE stuid = '$id' AND pwd = '$password'";
            $result = $conn->query($sql);
            $number = $result->fetch(); //mysqli_num_rows($result);
            if ($number) {
                $_SESSION['userData']="$_POST[id]";
                echo '<script>window.location="首頁&課表.php";</script>';
            } else {
                echo '<script>alert("學號 OR 密碼 錯誤!!");history.back(-1);</script>';
            }
        }  
    } else {  
        echo "<script>alert('ERROR'); history.go(-1);</script>";  
    }
?>


