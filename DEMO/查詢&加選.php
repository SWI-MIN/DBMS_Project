<!DOCTYPE html>
<html lang="zh-Hant-TW ">
<?php
    session_start();
    if(isset($_SESSION['userData'])) {
    } else {
      header("Location: ./login_index.php"); 
      exit();
    }
  ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DBMS_Project_查詢&加選</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="./login_style.css">
    <!--#########################################################################################-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    
    
    <style>
        body {
            font-family: Microsoft JhengHei, Arial;
        }
    </style>
    
</head>

<body>
    <!-- 我是導覽列 -->
    <nav class="navbar navbar-expand-md navbar-light bg-light p-1 fixed-top">
      <a class="navbar-brand ml-4" href="./首頁&課表.php" style="font-size: 30px;"><?php echo $_SESSION['userData'];?>學號</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar"
          aria-expanded="false" aria-controls="myNavbar">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-center">
              <li class="nav-item p-1" style="margin: 3px;">
                  <a href="./查詢&加選.php" class="nav-link" style="font-size: 18px; color: rgb( 100, 100, 100);">查詢與加選</a>
              </li>
              <li class="nav-item p-1" style="margin: 3px;">
                  <a href="./查詢&退選.php" class="nav-link" style="font-size: 18px; color: rgb( 100, 100, 100);">當前課程與退選</a>
              </li>
                
            </ul>
            <hr>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0 mr-2">
              <form name="login" action="logout.php" method="post">
                 <input action type="submit" name="logout" value="logout">
              </form>
            </ul>
        </div>
    </nav>
    
    <!-- /========================================我是分隔線======================================== -->

    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md- ml-sm-auto col-lg-12 px-4" style="padding-top: 100px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="h2">課表</h1>
                        <style type="text/css">
                            #contentTable{
                                table-layout:fixed; /* bootstrap-table設定colmuns中某列的寬度無效時，需要給整個表設定css屬性 */
                                word-break:break-all; word-wrap:break-all; /* 自動換行 */
                                padding: 0px 200px 0px 0px;
                                color: #000;
                                font-size: 15px;
                                font-family: Microsoft JhengHei, Arial;
                            }
                        </style>
                        <?php
                          include 'db_connect.php';
                          $conn = opDB();
                          $id = $_SESSION['userData'];

                          $Arr = array('一','二','三','四','五','六','日');
                          
                          $cname = array();
                          for( $i=0; $i<7; $i++ ) {
                              $wek = $Arr[$i];
                              $cname[$wek] = array();                     
                                  for($j = 1; $j < 15; $j++ ) { 
                                      $cname[$wek][$j] = "" ;
                                  }    
                              }                                 
                          
                          $cid = array();
                          for( $m=0; $m<7; $m++ ) {
                              $w = $Arr[$m];
                              $cid[$w] = array();                     
                              for($n = 1; $n < 15; $n++ ) { 
                                  $cid[$w][$n] = "" ;
                                  }    
                              } 
                          
      
                          $sql_1 = "SELECT courseid FROM choosing WHERE stuid=\"$id\"";
                          if ($result1 = $conn->query($sql_1)) {
                              while($row = $result1->fetch_assoc()) {
      
                                  $text = $row["courseid"];
                                  $sql_2 = "SELECT `courseid`,`week`,`period` FROM `courseTime` WHERE courseid=\"$text\"";
                                  $sql_3 = "SELECT `coursename` FROM `departCourse` WHERE courseid=\"$text\"";
                                  $result3 = $conn->query($sql_3);
                                  $course_name = $result3->fetch_assoc();
      
                                  if ($result2 = $conn->query($sql_2)) {
                                      
                                      while($row2 = $result2->fetch_assoc()) {
                                      //    echo $row2["week"].$row2["period"].gettype($row2["week"]).gettype($row2["period"])."<br>";
                                          foreach( $cname as $week  => $period ) {
                                              if( $row2["week"] == $week ) {
                                                  //$period[(int)$row2["period"]] = $course_name["coursename"];
                                                  //echo "hiii".$period[(int)$row2["period"]]."<br>";
                                                  $cname[$row2["week"]][(int)$row2["period"]] = $course_name["coursename"];
                                                  $cid[$row2["week"]][(int)$row2["period"]] = $row2["courseid"];
                                              }    
                                          }
                                             
                                      }
                                  } 
                              }
                          }
      
                          ?>
                          <table style="margin-right: auto; margin-left: auto;" id="contentTable" class="table table-hover table-bordered table-condensed text-center" >
                          
                              <thead>
                                  <tr class="thead-dark">
                                      <th style="width:75px;"></th>
                                      <th>一</th>
                                      <th>二</th>
                                      <th>三</th>
                                      <th>四</th>
                                      <th>五</th>
                                      <th>六</th>
                                      <th>日</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php   
                                  
                                      for( $k = 1; $k <15; $k++) {
                                          echo "<tr><th>第".$k."節</th>";
                                          foreach( $cname as $tabwek => $tabpe ){
                                                  echo "<td>".$tabpe[$k]."<br>".$cid[$tabwek][$k]."</td>";;
                                          }                                  
                                          echo "</tr>";
                                      }
                                          
                                  ?>
                                  
                              </tbody>
      
                          </table>
                  </div>

<!-- ==================================================  我是分隔線  ==================================================  -->

                    <div class="col-md-6">
                        <h1 class="h2">課程查詢</h1>
                        <!-- 查詢條件 --> 
                          <form method="post" class="inquire" >

                                &nbsp;&nbsp;
                                <label for="" class="form-inline">課程代號</label>
                                <input type="text" name="courseid" class="form-control" placeholder="課程代號" style="width: 75%;">
                                
                                <br>
                          <button type="submit" class="btn btn-primary" id="searchBtn">查詢</button>   
                          </form>
                          <br><br>  
                          
                            

                        <!-- 顯示出的表格 -->
                        <table style="width:90%;" id="contentTable" class="table table-hover table-bordered table-condensed text-center"  >
                            <thead>
                              <tr class="thead-light" >
                                <th style="width:20%;">課程代號</th>
                                <th style="width:20%;">老師</th>
                                <th style="width:30%;">課程名稱</th>
                                <th style="width:10%;">必選修</th>
                                <th style="width:10%;">學分數</th>

                                <th style="width:80px;"></th>
                              </tr>
                            </thead>
                            
                            <tbody>
                            <?php



                            ?>
                            <tr>
                                <td>09487</td>
                                <td>BBTIME</td>
                                <td>週四10:00~12:00</td>
                                <td>必</td>
                                <td>2</td>
                                <td><form action="opt_out.php"><button type="submit" class="btn btn-success btn-sm" id="searchBtn">加選</button></form></td>
                            </tr>
                            </tbody>

                            <?php
                                

                              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $courseid = trim($_POST["courseid"]);
                                
                                if( $courseid =="" || mb_strlen( $courseid, "utf-8")!=4){
                                    echo "<script type='text/javascript'>confirm(\"輸入值數量不對\")</script>"."<br>";
                                } else if($courseid !="" && mb_strlen( $courseid, "utf-8")==4){
                                    echo "";
                                    $sql0 = "SELECT maxstu,coursestu,courseunits,coursename FROM `departcourse` NATURAL JOIN `courseinfo` where courseid = \"$courseid\";";
                                    if ($stunum = mysqli_query($conn,$sql0)) {
                                        if (mysqli_num_rows($stunum) > 0) {   
                                            while($number= mysqli_fetch_assoc($stunum)){    // 印出每一個符合條件的 "課程代號"，並將 "學生ID" & "課程代號" 加入 choosing 表中
                                                if ($number["maxstu"] > ($number["coursestu"]+1) || $number["maxstu"] == ($number["coursestu"]+1) ) {
                                                    $unit = $number["courseunits"];
                                                    $choname = $number["coursename"];
                                                    $sq1 ="UPDATE courseinfo SET coursestu = (coursestu + 1) WHERE courseid = \"$courseid\";";
                                                    $sq2 ="INSERT INTO choosing(stuid,courseid) VALUES('$id','$courseid');";
                                                    $sq3 = "SELECT SUM(courseunits) FROM choosing NATURAL JOIN courseinfo WHERE stuid = \"$id\";"; 
                                                    $sq4 = "SELECT stuid,courseid,coursename FROM (students NATURAL JOIN choosing ) NATURAL JOIN departcourse  WHERE stuid = \"$id\";";

                                                    
                                                    if ( $cnamenum = mysqli_query($conn,$sq4) ) {
                                                        if (mysqli_num_rows($cnamenum) > 0) {
                                                            while ( $course = mysqli_fetch_assoc($cnamenum) ) {
                                                                if ( $choname == $course["coursename"] ) {
                                                                    echo '<script>history.back(-1);confirm("!不能選相同名稱的課程!");</script>';
                                                                } 
                                                            } 
                                                                if($stusum = $conn->query($sq3)) {
                                                                    $sum = mysqli_fetch_assoc($stusum);
                                                                                                                                
                                                                    if( 30 - $sum["SUM(courseunits)"] < $unit ) {
                                                                        echo "<script type='text/javascript'>confirm(\"總學分不能高於 30 學分 !\")</script>"; 
            
                                                                    } else {
                                                                        if ($conn->query($sq2)) {
                                                                            if ($conn->query($sq1)) {
                                                                                echo "<script type='text/javascript'>confirm(\"成功加選課程\");location.reload();</script>";
                                                                                header("Location: ./查詢&加選.php");
                                                                            } else {
                                                                                echo "<script type='text/javascript'>confirm(\"更新人數錯誤\")</script>";
                                                                                if($conn->query($sq2)){} else { echo "<script type='text/javascript'>confirm(\"新增choosing錯誤\")</script>"; }
                                                                            }
                                                                        } else { echo "<script type='text/javascript'>confirm(\"新增choosing錯誤(外)\")</script>"; 
                                                                            echo $id." ".$courseid." ". $conn->error ."<br>";
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo "<script type='text/javascript'>confirm(\"沒有總學分的查詢\")</script>";   }
                                                              }
                                                    }
                                                 } else {
                                                    echo "<script type='text/javascript'>confirm(\"人數已滿之課程不可加選\")</script>";// 前方的error相當於 mysql_error();，用於回傳錯誤訊息
                                                }
                                            }
                                        }
                                     } else {
                                         echo "<script type='text/javascript'>confirm(\"沒有這個 id\n\")</script>" . $conn->error . "<br>";
                                    }
                                } else {
                                    echo "加選字串判斷錯誤<br>";
                                }

                                
                                
                                }
                                /*

                                $sql_cho = "SELECT week,period FROM coursetime NATURAL JOIN choosing WHERE stuid = \"$id\";";
                                $sql_chen = "SELECT week,period FROM coursetime WHERE courseid = '1323';";
                                $count = 0;
                                if ($result_cho = $conn->query($sql_cho)){
                                while($cho = $result_cho->fetch_assoc()) {
                                        $week =$cho['week'];
                                        $period = $cho['period'];
                                        if ($result_chen = $conn->query($sql_chen)){
                                            while($chen = $result_chen->fetch_assoc()) {
                                                $chen_week = $chen['week'];
                                                $chen_period = $chen['period'];
                                                if ($week==$chen_week && $period==$chen_period)
                                                {
                                                    echo "<script type='text/javascript'>confirm(\"衝堂\")</script>";
                                                }
                                                else{
                                                    // echo "不衝堂";
                                                }
                                            }
                                        }
                                    }
                                } else {
                                echo "Error: " . "<br>" . $conn->error;
                                }
                                */
                            
                              ?>
                              
                            
                        </table>
                        </div>

                    </div>


            </main>
        </div>
        </div>
</body>
</html>
