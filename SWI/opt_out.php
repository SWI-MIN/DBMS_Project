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
    WHERE stuid = 'D0752939';";      // 取得某學生的總學分數
    $aa = $conn->query($sun_units);
    $value_1 = $aa->fetch();

    $a_llunits = "SELECT courseunits FROM choosing NATURAL JOIN courseinfo
    WHERE courseid='1318';"; // 取得學生要退選的那堂課的學分數
    $bb= $conn->query($a_llunits);
    $value_2 = $bb->fetch();

    $a_dep_01 = "SELECT stuid, courseid, studepart, stufloor, coursedepart, coursefloor, needed
    FROM (students NATURAL JOIN choosing ) NATURAL JOIN departcourse 
    WHERE stuid = 'D0752939' AND courseid = '1318' 
    AND studepart = coursedepart AND stufloor = coursefloor AND needed = 'M';";
    $a_dep_02= $conn->query($a_dep_01);
    $a_dep_03 = $a_dep_02->fetch();        // (6行)確認是否為該學生之必修，有值 = 必修，空值 = 非必修
    


// 下面這段可以試試
    $b_dep_01 = "SELECT courseid FROM choosing NATURAL JOIN courseinfo WHERE stuid='$id';";
    $b_dep_02= $conn->query($b_dep_01);
    $b_dep_03 = $b_dep_02->fetchAll(PDO::FETCH_ASSOC);
    $i=0;
    foreach($b_dep_03 as $b_dep_03){
        foreach($b_dep_03 as $key => $value[$i]){
            echo $key." : ".$value[$i]."<br />";
            $i++;
        }
    }
    echo $value[3];




    if(($value_1[0] - $value_2[0]) < 9) {
        echo '<script>alert(" 不能低於 9 學分 !!! ");history.go(-1);</script>';
        // echo $a_dep_03[0];
    } else if(!empty($a_dep_03[0])) {
        // echo $a_dep_03[0];
        echo '<script type="text/javascript"> 
        function reallydel(){ 
            var r=confirm("這是必修，你確定要退??")
            if (r==true){
                alert("假裝你成功退選嘞");
                history.go(-1);;
            } else {
                history.go(-1);
            }
        }
        reallydel();
        </script>';
    } else {
        echo '<script>alert("假裝你成功退選嘞");history.go(-1);</script>';

        // 執行退選這項工作的SQL
        // UPDATE courseinfo SET coursestu = (coursestu -1) WHERE courseid = '1318'; 退選的那門課人數減一
        // DELETE FROM choosing WHERE courseid = '1318' AND stuid = '學生';  刪除選課的那門課程
    }
    

?>