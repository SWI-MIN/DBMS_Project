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
    <title>DBMS_Project_首頁&課表</title>
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
            <main role="main" class="col-md- ml-sm-auto col-lg-12" style="padding-top: 100px;padding-bottom:40px;padding-left: 5%;padding-right: 5%;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <h1 class="text-center" style="padding: 0px 0px 0px 0px;">課表</h1>
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
                <br>
                <?php
                    include 'op&close_DB.php';
                    $conn = opDB();
                    $id = $_SESSION['userData'];

                    $Arr=array('一','二','三','四','五','六','日');
                    
                    $cname = array();
                    for( $i=0; $i<7; $i++ ) {
                        $wek = $Arr[$i];
                        $cname[$wek] = array();                     
                            for($j = 1; $j < 15; $j++ ) { 
                                $cname[$wek][$j] = "" ;
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
                                            echo "<td>".$tabpe[$k]."</td>";
                                    }                                     
                                    echo "</tr>";
                                }
                                    
                            ?>
                            
                        </tbody>

                    </table>
            </main>
            
        </div>
    </div>
</body>
</html>