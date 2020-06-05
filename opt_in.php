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
    WHERE stuid = 'D0752939';";      // 取得學生目前的總學分數
    $aa = $conn->query($sun_units);
    $value_1 = $aa->fetch();

    $a_llunits = "SELECT courseunits FROM choosing NATURAL JOIN courseinfo
    WHERE courseid='1318';"; // 取得學生要加選的那堂課的學分數
    $bb= $conn->query($a_llunits);
    $value_2 = $bb->fetch();
    

    $a_dep_01 = "SELECT * FROM `courseinfo` WHERE courseid = '1278' AND maxstu<=(coursestu+1);";
    $a_dep_02= $conn->query($a_dep_01);
    $a_dep_03 = $a_dep_02->fetch();        // (6行)確認該課程是否滿員，有值 = 滿員，空值 = 未滿
    
    // 這兩個我還沒寫，不是很想寫怎麼辦
        // 判斷是否為同名課程
        // 判斷是否衝堂

    if (($value_1[0] + $value_2[0]) > 30) {      // 判斷總學分是否超過30
        echo '<script>alert(" 總學分不能高於 30 學分 !!! ");history.go(-1);</script>';
    } else if (!empty($a_dep_03[0])) {           // 判斷是否達到修課人數上限
        echo '<script>alert(" 已達修課人數上限 !!! ");history.go(-1);</script>';
    } else if ($qqqqqq=="隨便拉") {           // 判斷是否為同名課程
        echo '<script>alert(" 不能選相同名稱的課程 !!! ");history.go(-1);</script>';
    } else if ($qqqqqq=="隨便拉") {           // 判斷是否衝堂
        echo '<script>alert(" 這門課程衝堂了喔 !!! ");history.go(-1);</script>';
    } else {                                    // 恭喜你能選這堂課
        echo '<script>alert("假裝你成功加選到了這門課");history.go(-1);</script>';

// 執行加選選這項工作的SQL
// $input = "INSERT INTO choosing (stuid, courseid) VALUES ('$stuid', '$number[courseid]');";   新增選的那門課程
// UPDATE courseinfo SET coursestu = (coursestu + 1) WHERE courseid = '1318(courseid)'; 加選選的那門課人數加一
    }
    

    // 還是老樣子，我不會取值，我不知道怎麼拿到  課程代號
    
?>