<?php
    header("Content-type: text/html; charset=utf-8");//頁面編碼
    $dbms='mysql';     //数据库类型
    $host='localhost'; //数据库主机名
    $dbName='dbms_project';    //使用的数据库
    $user='root';      //数据库连接用户名
    $pass='';          //对应的密码
    $dsn="$dbms:host=$host;dbname=$dbName";


    $stuid = $_POST['stuid'];                              //取得USER輸入的id
    $pwd = $_POST['pwd'];                                   //取得USER輸入的password
    $stuname = $_POST['stuname']; 
    $studepart = $_POST['studepart'];                              
    $stufloor = $_POST['stufloor'];                                   
    $stuclass = $_POST['stuclass'];

    $conn = new mysqli($host, $user, $pass, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    if ($stuid == '' || $pwd == '' || $stuname == '' || $studepart == '' || $stufloor == '' || $stuclass == ''){
        echo '<script>alert("通通不能為空!!");history.go(-1);</script>';
        exit(0);
    } else {
        $sql = "INSERT INTO students (stuid, pwd, stuname, studepart, stufloor, stuclass)
            VALUES ('$stuid', '$pwd', '$stuname', '$studepart', '$stufloor', '$stuclass' ); ";
        if ($conn->query($sql)) {           // query() 判斷資料庫查詢是否成功，if 成功回傳 true，else 回傳 false
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;//前方的error相當於 mysql_error();，用於迴船錯誤訊息
        }
    }  








    mysql_close($conn);
?>
