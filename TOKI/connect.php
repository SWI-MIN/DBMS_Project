<!DOCTYPE html>
<html lang="en">
<?php 
session_start();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>選課系統首頁</title>
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
      <a class="navbar-brand ml-4" href="index.php" style="font-size: 40px;">逢甲</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar"
          aria-expanded="false" aria-controls="myNavbar">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-center">
              <li class="nav-item p-1" style="margin: 3px;">
                  <a href="selection.php" class="nav-link" style="font-size: 18px; color: rgb( 100, 100, 100);">查詢與加選</a>
              </li>
              <li class="nav-item p-1" style="margin: 3px;">
                  <a href="remove.php" class="nav-link" style="font-size: 18px; color: rgb( 100, 100, 100);">當前課程與退選</a>
              </li>
                
            </ul>
            <hr>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0 mr-2">
            <li class="current-menu-item"><a href="connect.php"><?php echo ($_SESSION['userData']); ?></a></li>
            <li class="current-menu-item"><a href="index.php">登出</a></li>
                
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
            include 'function1.php';
            $conn = opDB();
            for($i=0 ; $i<=14 ; $i++){
                $w1[$i] =""; 
                $w2[$i] ="";
                $w3[$i] ="";
                $w4[$i] ="";
                $w5[$i] ="";
                $w6[$i] ="";
                $w7[$i] ="";
                $s1[$i] =""; 
                $s2[$i] ="";
                $s3[$i] ="";
                $s4[$i] ="";
                $s5[$i] ="";
                $s6[$i] ="";
                $s7[$i] ="";
            }
            $id = $_SESSION['userData'];
            // echo $id;
            $sql_1 = "SELECT courseid FROM choosing WHERE stuid=\"$id\"";
            if ($result1 = $conn->query($sql_1)) {
                // output data of each row
                while($row = $result1->fetch_assoc()) {
                    // echo "<br>";
                    // echo $row["courseid"];
                    $text = $row["courseid"];
                    $sql_2 = "SELECT `courseid`,`week`,`period` FROM `courseTime` WHERE courseid=\"$text\"";
                    $sql_3 = "SELECT `coursename` FROM `departCourse` WHERE courseid=\"$text\"";
                    $result3 = $conn->query($sql_3);
                    $course_name = $result3->fetch_assoc();
                    // print_r ($course_name);
                    if ($result2 = $conn->query($sql_2)) {
                        // output data of each row
                        while($row2 = $result2->fetch_assoc()) {
                            // $row3 = $result3->fetch_assoc();
                            // echo "<br>";
                            // echo $row2["week"];
                            // echo $row2["period"];
                            if($row2["week"]=='一'){
                                if($row2["period"]=='1'){
                                    $w1[1]=$course_name["coursename"];
                                    $s1[1]=$row2["courseid"];
                                }
                                if($row2["period"]=='2'){
                                    $w1[2]=$course_name["coursename"];
                                    $s1[2]=$row2["courseid"];
                                }
                                if($row2["period"]=='3'){
                                    $w1[3]=$course_name["coursename"];
                                    $s1[3]=$row2["courseid"];
                                }
                                if($row2["period"]=='4'){
                                    $w1[4]=$course_name["coursename"];
                                    $s1[4]=$row2["courseid"];
                                }
                                if($row2["period"]=='5'){
                                    $w1[5]=$course_name["coursename"];
                                    $s1[5]=$row2["courseid"];
                                }
                                if($row2["period"]=='6'){
                                    $w1[6]=$course_name["coursename"];
                                    $s1[6]=$row2["courseid"];
                                }
                                if($row2["period"]=='7'){
                                    $w1[7]=$course_name["coursename"];
                                    $s1[7]=$row2["courseid"];
                                }
                                if($row2["period"]=='8'){
                                    $w1[8]=$course_name["coursename"];
                                    $s1[8]=$row2["courseid"];
                                }
                                if($row2["period"]=='9'){
                                    $w1[9]=$course_name["coursename"];
                                    $s1[9]=$row2["courseid"];
                                }
                                if($row2["period"]=='10'){
                                    $w1[10]=$course_name["coursename"];
                                    $s1[10]=$row2["courseid"];
                                }
                                if($row2["period"]=='11'){
                                    $w1[11]=$course_name["coursename"];
                                    $s1[11]=$row2["courseid"];
                                }
                                if($row2["period"]=='12'){
                                    $w1[12]=$course_name["coursename"];
                                    $s1[12]=$row2["courseid"];
                                }
                                if($row2["period"]=='13'){
                                    $w1[13]=$course_name["coursename"];
                                    $s1[13]=$row2["courseid"];
                                }
                                if($row2["period"]=='14'){
                                    $w1[14]=$course_name["coursename"];
                                    $s1[14]=$row2["courseid"];
                                }
                            }
                            if($row2["week"]=='二'){
                                if($row2["period"]=='1'){
                                    $w2[1]=$course_name["coursename"];
                                    $s2[1]=$row2["courseid"];
                                }
                                if($row2["period"]=='2'){
                                    $w2[2]=$course_name["coursename"];
                                    $s2[2]=$row2["courseid"];
                                }
                                if($row2["period"]=='3'){
                                    $w2[3]=$course_name["coursename"];
                                    $s2[3]=$row2["courseid"];
                                }
                                if($row2["period"]=='4'){
                                    $w2[4]=$course_name["coursename"];
                                    $s2[4]=$row2["courseid"];
                                }
                                if($row2["period"]=='5'){
                                    $w2[5]=$course_name["coursename"];
                                    $s2[5]=$row2["courseid"];
                                }
                                if($row2["period"]=='6'){
                                    $w2[6]=$course_name["coursename"];
                                    $s2[6]=$row2["courseid"];
                                }
                                if($row2["period"]=='7'){
                                    $w2[7]=$course_name["coursename"];
                                    $s2[7]=$row2["courseid"];
                                }
                                if($row2["period"]=='8'){
                                    $w2[8]=$course_name["coursename"];
                                    $s2[8]=$row2["courseid"];
                                }
                                if($row2["period"]=='9'){
                                    $w2[9]=$course_name["coursename"];
                                    $s2[9]=$row2["courseid"];
                                }
                                if($row2["period"]=='10'){
                                    $w2[10]=$course_name["coursename"];
                                    $s2[10]=$row2["courseid"];
                                }
                                if($row2["period"]=='11'){
                                    $w2[11]=$course_name["coursename"];
                                    $s2[11]=$row2["courseid"];
                                }
                                if($row2["period"]=='12'){
                                    $w2[12]=$course_name["coursename"];
                                    $s2[12]=$row2["courseid"];
                                }
                                if($row2["period"]=='13'){
                                    $w2[13]=$course_name["coursename"];
                                    $s2[13]=$row2["courseid"];
                                }
                                if($row2["period"]=='14'){
                                    $w2[14]=$course_name["coursename"];
                                    $s2[14]=$row2["courseid"];
                                }
                            }
                            if($row2["week"]=='三'){
                                if($row2["period"]=='1'){
                                    $w3[1]=$course_name["coursename"];
                                    $s3[1]=$row2["courseid"];
                                }
                                if($row2["period"]=='2'){
                                    $w3[2]=$course_name["coursename"];
                                    $s3[2]=$row2["courseid"];
                                }
                                if($row2["period"]=='3'){
                                    $w3[3]=$course_name["coursename"];
                                    $s3[3]=$row2["courseid"];
                                }
                                if($row2["period"]=='4'){
                                    $w3[4]=$course_name["coursename"];
                                    $s3[4]=$row2["courseid"];
                                }
                                if($row2["period"]=='5'){
                                    $w3[5]=$course_name["coursename"];
                                    $s3[5]=$row2["courseid"];
                                }
                                if($row2["period"]=='6'){
                                    $w3[6]=$course_name["coursename"];
                                    $s3[6]=$row2["courseid"];
                                }
                                if($row2["period"]=='7'){
                                    $w3[7]=$course_name["coursename"];
                                    $s3[7]=$row2["courseid"];
                                }
                                if($row2["period"]=='8'){
                                    $w3[8]=$course_name["coursename"];
                                    $s3[8]=$row2["courseid"];
                                }
                                if($row2["period"]=='9'){
                                    $w3[9]=$course_name["coursename"];
                                    $s3[9]=$row2["courseid"];
                                }
                                if($row2["period"]=='10'){
                                    $w3[10]=$course_name["coursename"];
                                    $s3[10]=$row2["courseid"];
                                }
                                if($row2["period"]=='11'){
                                    $w3[11]=$course_name["coursename"];
                                    $s3[11]=$row2["courseid"];
                                }
                                if($row2["period"]=='12'){
                                    $w3[12]=$course_name["coursename"];
                                    $s3[12]=$row2["courseid"];
                                }
                                if($row2["period"]=='13'){
                                    $w3[13]=$course_name["coursename"];
                                    $s3[13]=$row2["courseid"];
                                }
                                if($row2["period"]=='14'){
                                    $w3[14]=$course_name["coursename"];
                                    $s3[14]=$row2["courseid"];
                                }
                            }
                            if($row2["week"]=='四'){
                                if($row2["period"]=='1'){
                                    $w4[1]=$course_name["coursename"];
                                    $s4[1]=$row2["courseid"];
                                }
                                if($row2["period"]=='2'){
                                    $w4[2]=$course_name["coursename"];
                                    $s4[2]=$row2["courseid"];
                                }
                                if($row2["period"]=='3'){
                                    $w4[3]=$course_name["coursename"];
                                    $s4[3]=$row2["courseid"];
                                }
                                if($row2["period"]=='4'){
                                    $w4[4]=$course_name["coursename"];
                                    $s4[4]=$row2["courseid"];
                                }
                                if($row2["period"]=='5'){
                                    $w4[5]=$course_name["coursename"];
                                    $s4[5]=$row2["courseid"];
                                }
                                if($row2["period"]=='6'){
                                    $w4[6]=$course_name["coursename"];
                                    $s4[6]=$row2["courseid"];
                                }
                                if($row2["period"]=='7'){
                                    $w4[7]=$course_name["coursename"];
                                    $s4[7]=$row2["courseid"];
                                }
                                if($row2["period"]=='8'){
                                    $w4[8]=$course_name["coursename"];
                                    $s4[8]=$row2["courseid"];
                                }
                                if($row2["period"]=='9'){
                                    $w4[9]=$course_name["coursename"];
                                    $s4[9]=$row2["courseid"];
                                }
                                if($row2["period"]=='10'){
                                    $w4[10]=$course_name["coursename"];
                                    $s4[10]=$row2["courseid"];
                                }
                                if($row2["period"]=='11'){
                                    $w4[11]=$course_name["coursename"];
                                    $s4[11]=$row2["courseid"];
                                }
                                if($row2["period"]=='12'){
                                    $w4[12]=$course_name["coursename"];
                                    $s4[12]=$row2["courseid"];
                                }
                                if($row2["period"]=='13'){
                                    $w4[13]=$course_name["coursename"];
                                    $s4[13]=$row2["courseid"];
                                }
                                if($row2["period"]=='14'){
                                    $w4[14]=$course_name["coursename"];
                                    $s4[14]=$row2["courseid"];
                                }
                            }
                            if($row2["week"]=='五'){
                                if($row2["period"]=='1'){
                                    $w5[1]=$course_name["coursename"];
                                    $s5[1]=$row2["courseid"];
                                }
                                if($row2["period"]=='2'){
                                    $w5[2]=$course_name["coursename"];
                                    $s5[2]=$row2["courseid"];
                                }
                                if($row2["period"]=='3'){
                                    $w5[3]=$course_name["coursename"];
                                    $s5[3]=$row2["courseid"];
                                }
                                if($row2["period"]=='4'){
                                    $w5[4]=$course_name["coursename"];
                                    $s5[4]=$row2["courseid"];
                                }
                                if($row2["period"]=='5'){
                                    $w5[5]=$course_name["coursename"];
                                    $s5[5]=$row2["courseid"];
                                }
                                if($row2["period"]=='6'){
                                    $w5[6]=$course_name["coursename"];
                                    $s5[6]=$row2["courseid"];
                                }
                                if($row2["period"]=='7'){
                                    $w5[7]=$course_name["coursename"];
                                    $s5[7]=$row2["courseid"];
                                }
                                if($row2["period"]=='8'){
                                    $w5[8]=$course_name["coursename"];
                                    $s5[8]=$row2["courseid"];
                                }
                                if($row2["period"]=='9'){
                                    $w5[9]=$course_name["coursename"];
                                    $s5[9]=$row2["courseid"];
                                }
                                if($row2["period"]=='10'){
                                    $w5[10]=$course_name["coursename"];
                                    $s5[10]=$row2["courseid"];
                                }
                                if($row2["period"]=='11'){
                                    $w5[11]=$course_name["coursename"];
                                    $s5[11]=$row2["courseid"];
                                }
                                if($row2["period"]=='12'){
                                    $w5[12]=$course_name["coursename"];
                                    $s5[12]=$row2["courseid"];
                                }
                                if($row2["period"]=='13'){
                                    $w5[13]=$course_name["coursename"];
                                    $s5[13]=$row2["courseid"];
                                }
                                if($row2["period"]=='14'){
                                    $w5[14]=$course_name["coursename"];
                                    $s5[14]=$row2["courseid"];
                                }
                            }
                            if($row2["week"]=='六'){
                                if($row2["period"]=='1'){
                                    $w6[1]=$course_name["coursename"];
                                    $s6[1]=$row2["courseid"];
                                }
                                if($row2["period"]=='2'){
                                    $w6[2]=$course_name["coursename"];
                                    $s6[2]=$row2["courseid"];
                                }
                                if($row2["period"]=='3'){
                                    $w6[3]=$course_name["coursename"];
                                    $s6[3]=$row2["courseid"];
                                }
                                if($row2["period"]=='4'){
                                    $w6[4]=$course_name["coursename"];
                                    $s6[4]=$row2["courseid"];
                                }
                                if($row2["period"]=='5'){
                                    $w6[5]=$course_name["coursename"];
                                    $s6[5]=$row2["courseid"];
                                }
                                if($row2["period"]=='6'){
                                    $w6[6]=$course_name["coursename"];
                                    $s6[6]=$row2["courseid"];
                                }
                                if($row2["period"]=='7'){
                                    $w6[7]=$course_name["coursename"];
                                    $s6[7]=$row2["courseid"];
                                }
                                if($row2["period"]=='8'){
                                    $w6[8]=$course_name["coursename"];
                                    $s6[8]=$row2["courseid"];
                                }
                                if($row2["period"]=='9'){
                                    $w6[9]=$course_name["coursename"];
                                    $s6[9]=$row2["courseid"];
                                }
                                if($row2["period"]=='10'){
                                    $w6[10]=$course_name["coursename"];
                                    $s6[10]=$row2["courseid"];
                                }
                                if($row2["period"]=='11'){
                                    $w6[11]=$course_name["coursename"];
                                    $s6[11]=$row2["courseid"];
                                }
                                if($row2["period"]=='12'){
                                    $w6[12]=$course_name["coursename"];
                                    $s6[12]=$row2["courseid"];
                                }
                                if($row2["period"]=='13'){
                                    $w6[13]=$course_name["coursename"];
                                    $s6[13]=$row2["courseid"];
                                }
                                if($row2["period"]=='14'){
                                    $w6[14]=$course_name["coursename"];
                                    $s6[14]=$row2["courseid"];
                                }
                            }
                            if($row2["week"]=='日'){
                                if($row2["period"]=='1'){
                                    $w7[1]=$course_name["coursename"];
                                    $s7[1]=$row2["courseid"];
                                }
                                if($row2["period"]=='2'){
                                    $w7[2]=$course_name["coursename"];
                                    $s7[2]=$row2["courseid"];
                                }
                                if($row2["period"]=='3'){
                                    $w7[3]=$course_name["coursename"];
                                    $s7[3]=$row2["courseid"];
                                }
                                if($row2["period"]=='4'){
                                    $w7[4]=$course_name["coursename"];
                                    $s7[4]=$row2["courseid"];
                                }
                                if($row2["period"]=='5'){
                                    $w7[5]=$course_name["coursename"];
                                    $s7[5]=$row2["courseid"];
                                }
                                if($row2["period"]=='6'){
                                    $w7[6]=$course_name["coursename"];
                                    $s7[6]=$row2["courseid"];
                                }
                                if($row2["period"]=='7'){
                                    $w7[7]=$course_name["coursename"];
                                    $s7[7]=$row2["courseid"];
                                }
                                if($row2["period"]=='8'){
                                    $w7[8]=$course_name["coursename"];
                                    $s7[8]=$row2["courseid"];
                                }
                                if($row2["period"]=='9'){
                                    $w7[9]=$course_name["coursename"];
                                    $s7[9]=$row2["courseid"];
                                }
                                if($row2["period"]=='10'){
                                    $w7[10]=$course_name["coursename"];
                                    $s7[10]=$row2["courseid"];
                                }
                                if($row2["period"]=='11'){
                                    $w7[11]=$course_name["coursename"];
                                    $s7[11]=$row2["courseid"];
                                }
                                if($row2["period"]=='12'){
                                    $w7[12]=$course_name["coursename"];
                                    $s7[12]=$row2["courseid"];
                                }
                                if($row2["period"]=='13'){
                                    $w7[13]=$course_name["coursename"];
                                    $s7[13]=$row2["courseid"];
                                }
                                if($row2["period"]=='14'){
                                    $w7[14]=$course_name["coursename"];
                                    $s7[14]=$row2["courseid"];
                                }
                            }
                            
                        }
                      } else {
                        echo "<br>error<br>";
                      }
                }
              } else {
                echo "<br>error<br>";
              }
            CloseCon($conn);
            ?>
            <table id="contentTable" class="table table-hover table-bordered table-condensed text-center" >
                    
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
                      <tr>
                        <th>第1節</th>
                        <td>
                            <?php 
                            print_r ($w1[1]);
                            echo "<br>";
                            print_r ($s1[1]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[1]);
                            echo "<br>";
                            print_r ($s2[1]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[1]);
                            echo "<br>";
                            print_r ($s3[1]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[1]);
                            echo "<br>";
                            print_r ($s4[1]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[1]);
                            echo "<br>";
                            print_r ($s5[1]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[1]);
                            echo "<br>";
                            print_r ($s6[1]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[1]);
                            echo "<br>";
                            print_r ($s7[1]);
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <th>第2節</th>
                        <td>
                            <?php 
                            print_r ($w1[2]);
                            echo "<br>";
                            print_r ($s1[2]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[2]);
                            echo "<br>";
                            print_r ($s2[2]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[2]);
                            echo "<br>";
                            print_r ($s3[2]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[2]);
                            echo "<br>";
                            print_r ($s4[2]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[2]);
                            echo "<br>";
                            print_r ($s5[2]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[2]);
                            echo "<br>";
                            print_r ($s6[2]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[2]);
                            echo "<br>";
                            print_r ($s7[2]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第3節</th>
                        <td>
                            <?php 
                            print_r ($w1[3]);
                            echo "<br>";
                            print_r ($s1[3]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[3]);
                            echo "<br>";
                            print_r ($s2[3]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[3]);
                            echo "<br>";
                            print_r ($s3[3]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[3]);
                            echo "<br>";
                            print_r ($s4[3]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[3]);
                            echo "<br>";
                            print_r ($s5[3]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[3]);
                            echo "<br>";
                            print_r ($s6[3]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[3]);
                            echo "<br>";
                            print_r ($s7[3]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第4節</th>
                        <td>
                            <?php 
                            print_r ($w1[4]);
                            echo "<br>";
                            print_r ($s1[4]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[4]);
                            echo "<br>";
                            print_r ($s2[4]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[4]);
                            echo "<br>";
                            print_r ($s3[4]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[4]);
                            echo "<br>";
                            print_r ($s4[4]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[4]);
                            echo "<br>";
                            print_r ($s5[4]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[4]);
                            echo "<br>";
                            print_r ($s6[4]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[4]);
                            echo "<br>";
                            print_r ($s7[4]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第5節</th>
                        <td>
                            <?php 
                            print_r ($w1[5]);
                            echo "<br>";
                            print_r ($s1[5]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[5]);
                            echo "<br>";
                            print_r ($s2[5]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[5]);
                            echo "<br>";
                            print_r ($s3[5]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[5]);
                            echo "<br>";
                            print_r ($s4[5]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[5]);
                            echo "<br>";
                            print_r ($s5[5]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[5]);
                            echo "<br>";
                            print_r ($s6[5]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[5]);
                            echo "<br>";
                            print_r ($s7[5]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第6節</th>
                        <td>
                            <?php 
                            print_r ($w1[6]);
                            echo "<br>";
                            print_r ($s1[6]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[6]);
                            echo "<br>";
                            print_r ($s2[6]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[6]);
                            echo "<br>";
                            print_r ($s3[6]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[6]);
                            echo "<br>";
                            print_r ($s4[6]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[6]);
                            echo "<br>";
                            print_r ($s5[6]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[6]);
                            echo "<br>";
                            print_r ($s6[6]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[6]);
                            echo "<br>";
                            print_r ($s7[6]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第7節</th>
                        <td>
                            <?php 
                            print_r ($w1[7]);
                            echo "<br>";
                            print_r ($s1[7]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[7]);
                            echo "<br>";
                            print_r ($s2[7]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[7]);
                            echo "<br>";
                            print_r ($s3[7]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[7]);
                            echo "<br>";
                            print_r ($s4[7]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[7]);
                            echo "<br>";
                            print_r ($s5[7]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[7]);
                            echo "<br>";
                            print_r ($s6[7]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[7]);
                            echo "<br>";
                            print_r ($s7[7]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第8節</th>
                        <td>
                            <?php 
                            print_r ($w1[8]);
                            echo "<br>";
                            print_r ($s1[8]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[8]);
                            echo "<br>";
                            print_r ($s2[8]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[8]);
                            echo "<br>";
                            print_r ($s3[8]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[8]);
                            echo "<br>";
                            print_r ($s4[8]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[8]);
                            echo "<br>";
                            print_r ($s5[8]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[8]);
                            echo "<br>";
                            print_r ($s6[8]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[8]);
                            echo "<br>";
                            print_r ($s7[8]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第9節</th>
                        <td>
                            <?php 
                            print_r ($w1[9]);
                            echo "<br>";
                            print_r ($s1[9]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[9]);
                            echo "<br>";
                            print_r ($s2[9]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[9]);
                            echo "<br>";
                            print_r ($s3[9]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[9]);
                            echo "<br>";
                            print_r ($s4[9]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[9]);
                            echo "<br>";
                            print_r ($s5[1]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[9]);
                            echo "<br>";
                            print_r ($s6[9]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[9]);
                            echo "<br>";
                            print_r ($s7[9]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第10節</th>
                        <td>
                            <?php 
                            print_r ($w1[10]);
                            echo "<br>";
                            print_r ($s1[10]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[10]);
                            echo "<br>";
                            print_r ($s2[10]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[10]);
                            echo "<br>";
                            print_r ($s3[10]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[10]);
                            echo "<br>";
                            print_r ($s4[10]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[10]);
                            echo "<br>";
                            print_r ($s5[10]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[10]);
                            echo "<br>";
                            print_r ($s6[10]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[10]);
                            echo "<br>";
                            print_r ($s7[10]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第11節</th>
                        <td>
                            <?php 
                            print_r ($w1[11]);
                            echo "<br>";
                            print_r ($s1[11]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[11]);
                            echo "<br>";
                            print_r ($s2[11]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[11]);
                            echo "<br>";
                            print_r ($s3[11]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[11]);
                            echo "<br>";
                            print_r ($s4[11]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[11]);
                            echo "<br>";
                            print_r ($s5[11]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[11]);
                            echo "<br>";
                            print_r ($s6[11]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[11]);
                            echo "<br>";
                            print_r ($s7[11]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第12節</th>
                        <td>
                            <?php 
                            print_r ($w1[12]);
                            echo "<br>";
                            print_r ($s1[12]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[12]);
                            echo "<br>";
                            print_r ($s2[12]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[12]);
                            echo "<br>";
                            print_r ($s3[12]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[12]);
                            echo "<br>";
                            print_r ($s4[12]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[12]);
                            echo "<br>";
                            print_r ($s5[12]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[12]);
                            echo "<br>";
                            print_r ($s6[12]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[12]);
                            echo "<br>";
                            print_r ($s7[12]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第13節</th>
                        <td>
                            <?php 
                            print_r ($w1[13]);
                            echo "<br>";
                            print_r ($s1[13]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[13]);
                            echo "<br>";
                            print_r ($s2[13]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[13]);
                            echo "<br>";
                            print_r ($s3[13]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[13]);
                            echo "<br>";
                            print_r ($s4[13]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[13]);
                            echo "<br>";
                            print_r ($s5[13]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[13]);
                            echo "<br>";
                            print_r ($s6[13]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[13]);
                            echo "<br>";
                            print_r ($s7[13]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                      <tr>
                        <th>第14節</th>
                        <td>
                            <?php 
                            print_r ($w1[14]);
                            echo "<br>";
                            print_r ($s1[14]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w2[14]);
                            echo "<br>";
                            print_r ($s2[14]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w3[14]);
                            echo "<br>";
                            print_r ($s3[14]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w4[14]);
                            echo "<br>";
                            print_r ($s4[14]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w5[14]);
                            echo "<br>";
                            print_r ($s5[14]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w6[14]);
                            echo "<br>";
                            print_r ($s6[14]);
                            ?>
                        </td>
                        <td>
                            <?php 
                            print_r ($w7[14]);
                            echo "<br>";
                            print_r ($s7[14]);
                            ?>
                        </td>
                      </tr>
                      </tr>
                    </tbody>

                </table>
            </main>
            
        </div>
    </div>
</body>
</html>