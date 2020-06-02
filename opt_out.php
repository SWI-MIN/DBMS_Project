<?php
    header("Content-type: text/html; charset=utf-8");//頁面編碼
    session_start();
    $dbms='mysql';     //数据库类型
    $host='localhost'; //数据库主机名
    $dbName='dbms_project';    //使用的数据库
    $user='root';      //数据库连接用户名
    $pass='';          //对应的密码
    $dsn="$dbms:host=$host;dbname=$dbName";
    $conn = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));// 連接資料庫

    $id = $_SESSION['userData'];      // 取得登入者資料

    $sun_units = "SELECT SUM(courseunits) FROM choosing NATURAL JOIN courseinfo
    WHERE stuid = 'D0752939' GROUP BY courseunits;";      // 取得某學生的總學分數
    $aa = $conn->query($sun_units);
    $value_1 = $aa->fetch();
    // echo "$value_1[0]";
    $a_llunits = "SELECT courseunits FROM choosing NATURAL JOIN courseinfo
    WHERE courseid='1318';"; // 取得學生要退選的那堂課的學分數
    $bb= $conn->query($a_llunits);
    $value_2 = $bb->fetch();
    // echo "$value_2[0]";
    echo "$value_1[0]" - "$value_2[0]";

    $a_dep_01 = "SELECT stuid, courseid, studepart, stufloor, coursedepart, coursefloor, needed
    FROM (students NATURAL JOIN choosing ) NATURAL JOIN departcourse 
    WHERE stuid = 'D0752939' AND courseid = '1318' 
    AND studepart = coursedepart AND stufloor = coursefloor AND needed = 'M';";
    $a_dep_02= $conn->query($a_dep_01);
    $a_dep_03 = $a_dep_02->fetch();        // (6行)確認是否為該學生之必修，有值 = 必修，空值 = 非必修
    echo "$a_dep_03[0]";
    
    
    
    if(($value_1[0] - $value_2[0]) > 9) {
        echo '<script>alert(" 不能低於 9 學分 !!! ");history.go(-1);</script>';
        $a_dep_03[0];
    } else if(!empty($a_dep_03[0])) {
        $a_dep_03[0];
        echo '<script type="text/javascript"> 
        function reallydel(){ 
            var r=confirm("這是必修，你確定要退??")
            if (r==true){
            document.write("You pressed OK!")
            } else {
            document.onclick = delete_confirm;
            }
        }
        </script>';
        $a_dep_03[0];
    } else {
        $a_dep_03[0];
    }
    

?>