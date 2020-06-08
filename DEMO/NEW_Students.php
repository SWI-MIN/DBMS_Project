<?php
    header("Content-type: text/html; charset=utf-8");//頁面編碼

    include 'db_connect.php';
    $conn = opDB();
    
    $stuid = $_POST['stuid'];                              //取得USER輸入的id
    $pwd = $_POST['pwd'];                                   //取得USER輸入的password
    $stuname = $_POST['stuname']; 
    $studepart = $_POST['studepart'];                              
    $stufloor = $_POST['stufloor'];                                   
    $stuclass = $_POST['stuclass'];

    // $conn = new mysqli($host, $user, $pass, $dbName);       // 連接資料庫
    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($stuid == '' || $pwd == '' || $stuname == '' || $studepart == '' || $stufloor == '' || $stuclass == ''){    // 判斷輸入值是否為空
        echo '<script>alert("通通不能為空!!");history.go(-1);</script>';
        exit();
    } else {
        $sql = "INSERT INTO students (stuid, pwd, stuname, studepart, stufloor, stuclass) 
                    VALUES ('$stuid', '$pwd', '$stuname', '$studepart', '$stufloor', '$stuclass' ); "; 
        if ($conn->query($sql)) {           // query() 判斷資料庫查詢是否成功，if 成功回傳 true，else 回傳 false
            echo "New Students successfully";
            echo '<br><br>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;//前方的error相當於 mysql_error();，用於回傳 query 的錯誤訊息
        } 
    }  

    $subject= "SELECT * FROM departcourse WHERE coursedepart = '$_POST[studepart]' 
            AND	coursefloor = '$_POST[stufloor]' AND courseclass = '$_POST[stuclass]' AND needed = 'M'";// 搜尋"系所課程"這張表中，符合 "課程系所","課程年級","班級","必選修"
    if($result = mysqli_query($conn, $subject)){ // 如果有值
        if (mysqli_num_rows($result) > 0) {   
            while($number= mysqli_fetch_assoc($result)){    // 印出每一個符合條件的 "課程代號"，並將 "學生ID" & "課程代號" 加入 choosing 表中
                if ($number["coursedepart"] == $studepart && $number["coursefloor"] ==  $stufloor  && $number["courseclass"] ==  $stuclass) {
                    echo $number["courseid"];       // 印出符合條件的 "課程代號"
                    echo '  -->  ';
                    $input = "INSERT INTO choosing (stuid, courseid) VALUES ('$stuid', '$number[courseid]'); "; // 將 "學生ID" & "課程代號" 加入 choosing 表中
                    if ($conn->query($input)) {           // query() 判斷新增資料是否成功，if 成功回傳 true，else 回傳 false
                        echo "New choosing[ stuid , courseid ] successfully";
                        echo '<br>';
                    } else {
                        echo "Error: " . $input . "<br>" . $conn->error . "<br>";// 前方的error相當於 mysql_error();，用於回傳錯誤訊息
                    }
                }
            } 
        } else {  echo 'not match'; }        
    }
?>
