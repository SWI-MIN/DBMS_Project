<!DOCTYPE html>
<html lang="en">
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
    <title>DBMS_Project_查詢&退選</title>
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
                
              <form name="logout" action="logout.php" method="post">
                <input action type="submit" name="logout" value="logout">
             </form>
              
          </ul>
        </div>
    </nav>
    <!-- modal -->
    
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
                        <div class="col-md-6">
                        <h1 class="h2">已選課程</h1>
                        <!-- 查詢條件 -->
                        
                       
                        <!-- 顯示出的表格 -->
                        <table id="contentTable" class="table table-hover table-bordered table-condensed text-center" >
                            <thead>
                              <tr class="thead-light">
                                <th style="width:16%;">課程代號</th>
                                <th style="width:15%;">老師</th>
                                <th style="width:25%;">課程名</th>
                                <th style="width:12%;">必選修</th>
                                <th style="width:12%;">學分數</th>

                                <th style="width:65px;"></th>
                              </tr>
                            </thead>
                            
                            <tbody>
                            
                            <!-- ==================================================  我是分隔線  ==================================================  -->
                            <?php 
                            // // $id;
                            // $conn = opDB();
                            // $id = $_SESSION['userData'];
                            // $j = 1;
                            // echo $id;
                            // // echo "<br>";
                            // for ($j=1;$j<=30;$j++)
                            // {
                            //     $course[$j]="";
                            // }
                            // $j = 1;
                            // $sql_4 = "SELECT courseid FROM choosing WHERE stuid=\"$id\"";
                            // if ($result4 = $conn->query($sql_4)) {
                            //     while($row4 = $result4->fetch_assoc()) {
                            //         // echo "<br>==================<br>";
                            //         // echo $row4["courseid"];
                            //         // echo "<br>==================<br>";
                            //         $course[$j] = $row4["courseid"];
                            //         $j = $j + 1 ;
                            //         // echo $course[$j];
                            //     }
                            // }
                            // $j = 1;
                            // for ($j=1;$j<=30;$j++) {
                            //     if ($course[$j]!=null) {
                            //         echo "<br>";
                            //         echo $course[$j];
                            //     }
                            // }

                            
                            ?>
                            <!-- ==================================================  我是分隔線  ==================================================  -->

                              <?php
                                // include 'function1.php';
                                $connn = opDB();
                                // for($i=0 ; $i<=30 ; $i++){
                                //     $data1[$i] =""; 
                                //     $data2[$i] =""; 
                                //     $data3[$i] =""; 
                                //     $data4[$i] =""; 
                                //     $data5[$i] =""; 
                                // }
                                $sum = 0;
                                $sun_units = "SELECT SUM(courseunits) FROM choosing NATURAL JOIN courseinfo WHERE stuid=\"$id\";";
                                if ($result6 = $conn->query($sun_units)) {
                                    while($row6 = $result6->fetch_assoc()) {
                                        $sum = $row6["SUM(courseunits)"];
                                    }
                                    // echo $sum;
                                }
                                
                                
                                // $countsql = "SELECT SUM(courseunits) FROM choosing NATURAL JOIN courseinfo WHERE stuid=\"$id\" GROUP BY coursenuits

                                $id = $_SESSION['userData'];
                                echo "學生：";
                                echo $id;
                                echo "   目前學分數： ";
                                echo $sum;
                                $sql_4 = "SELECT courseid FROM choosing WHERE stuid=\"$id\"";
                                if ($result4 = $conn->query($sql_4)) {
                                    // output data of each row
                                    // $a = 0;
                                    while($row4 = $result4->fetch_assoc()) {
                                        // echo "<br>";
                                        // echo "<br>";
                                        // echo $row4["courseid"];
                                        
                                        $cor_id = $row4["courseid"];
                                        $sql_5 = "SELECT  courseid, teachername, coursename, needed, courseunits FROM DepartCourse NATURAL JOIN courseinfo WHERE courseid= \"$cor_id\" ;";
                                        // echo $cor_id;       
                                        if ($result5 = $conn->query($sql_5)) {
                                            $textxxx = "";
                                            while($row5 = $result5->fetch_assoc()) 
                                            {
                                                if ($row5["courseid"]!=$textxxx) {
                                                $data1 = $row5["courseid"];
                                                // echo $data1;
                                                $textxxx = $data1;
                                                $data2 = $row5["teachername"];
                                                $data3 = $row5["coursename"];
                                                $data4 = $row5["needed"];
                                                $data5 = $row5["courseunits"];
                                                
                                                $sql_7 = "SELECT courseunits FROM courseinfo  WHERE courseid = \"$data1\"   ";
                                                if ($result7 = $conn->query($sql_7)) {
                                                    
                                                    while($row7 = $result7->fetch_assoc()) {
                                                        $chose_count = $row7["courseunits"];
                                                    }
                                                    // echo $chose_count;
                                                    
                                                }
                                                $text123 = "1";
                                                $a_dep_01 = "SELECT stuid, courseid, studepart, stufloor, coursedepart, coursefloor, needed
                                                    FROM (students NATURAL JOIN choosing ) NATURAL JOIN departcourse 
                                                    WHERE stuid = '$id' AND courseid = '$data1' 
                                                    AND studepart = coursedepart AND stufloor = coursefloor AND needed = 'M';";
                                                if ($result7 = $conn->query($a_dep_01)) {
                                                    while($row7 = $result7->fetch_assoc()) {
                                                        
                                                        $text123 = "123";
                                                        // echo $text123;

                                                        
                                                        
                                                    } 
                                                        
                                                }
                                                    
                                                
                                                ?>
                                                <tr>
                                                <td><?php echo $data1;?></td>
                                                <td><?php echo $data2;?></td>
                                                <td><?php echo $data3;?></td>
                                                <td><?php echo $data4;?></td>
                                                <td><?php echo $data5;?></td>
                                                <td> 
                                                <!-- <script>
                                                function express(){
                                                var value="abc";
                                                var a123="123";
                                                location.href="print.php?value=" +value+a123;
                                                history.go(0);
                                                }
                                                </script>
                                                <input type="button" value="button" onclick="express()"> -->
                                                <button  type="submit" onclick="btn_click(<?php echo $data1; ?>,<?php echo $chose_count; ?>,<?php echo $text123; ?>)"  class="btn btn-danger btn-sm" >
                                                    退選
                                                
                                                </button>

                                                </td>
                                                
                                                </tr>

                                                <?php 
                                            }
                                            
                                        }
                                        }
                                    }
                                }


                                //==============================================================
                                
                                
                                // $dbms='mysql';     
                                // $host='localhost'; 
                                // $dbName='dbms_project';    
                                // $user='root';      
                                // $pass='';          
                                // $dsn="$dbms:host=$host;dbname=$dbName";
                                // $conn = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
                                // $id = $_SESSION['userData'];
                                // $sun_units = "SELECT SUM(courseunits) FROM choosing NATURAL JOIN courseinfo
                                // WHERE stuid=\"$id\"  GROUP BY courseunits;";
                                // $aa = $conn->query($sun_units);
                                // $value_1 = $aa->fetch();
                                // // echo "$value_1[0]";
                                // $a_llunits = "SELECT courseunits FROM choosing NATURAL JOIN courseinfo WHERE courseid='1318'";
                                // $bb= $conn->query($a_llunits);
                                // $value_2 = $bb->fetch();
                                // // echo "$value_2[0]";

                                // //==============================================================
                                // $count = $value_1[0] - $value_2[0];
                                // echo $count;
                                
                                ?>

                                <!-- <script language="javascript">
                                function btn_click(x,y,z) {
                                    var id="<?php echo $id; ?>";
                                    var course = x;
                                    var sum="<?php echo $sum; ?>";
                                    var faQ=y;
                                    
                                    
                                    
                                    var needed = z;
                                    if (sum - faQ <9 || sum - faQ >30) {
                                        alert("分數會低於九學分! 不能退選喔");
                                    }
                                    else {
                                        if (needed==123){
                                            var r=confirm("這是必修，你確定要退??")
                                            if (r==true){
                                                alert("假裝你成功退選嘞");

                                                history.go(-1);
                                            } else {
                                                
                                            }
                                        }
                                        else{
                                            alert("這不是必選");
                                        }
                                        
                                        
                                    }
                                
                                // 　alert(y);
                                
                                }
                                </script> -->
                                
                            </tbody>
                            
                        </table>

                    </div>
                    
                </div>
    <script language="javascript">
    function btn_click(x,y,z) {
        var id="<?php echo $id; ?>";
        var course = x;
        var sum="<?php echo $sum; ?>";
        var units=y;

        var needed = z;
        if ( sum - units < 9 ) {
        alert("總學分會低於九學分! 不能退選喔");
        }
        else {
            if ( needed == 123){
            var r=confirm("這是必修，你確定要退??")
                if ( r == true){
                location.href="delect.php?value="+ course;
                
                // history.go(-1);
                } 
            }  else {
            location.href="delect.php?value="+ course;
            // history.go(0);
            }
                                                    
        }
                                            
        // 　alert(y);
                                            
    }
    </script>
</body>
</html>

            

           