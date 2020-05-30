<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if(isset($_SESSION['userData'])){
    // exit();
}
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
                  <a href="exit.php" class="nav-link" style="font-size: 18px; color: rgb( 100, 100, 100);">查詢與加選</a>
              </li>
              <li class="nav-item p-1" style="margin: 3px;">
                  <a href="exit.php" class="nav-link" style="font-size: 18px; color: rgb( 100, 100, 100);">當前課程與退選</a>
              </li>
                
            </ul>
            <hr>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0 mr-2">
            <li class="current-menu-item"><a href="connect.php">註冊</a></li>
                
            </ul>
        </div>
    </nav>
    <!-- /========================================我是分隔線======================================== -->

    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md- ml-sm-auto col-lg-12" style="padding-top: 100px;padding-bottom:40px;padding-left: 5%;padding-right: 5%;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <h1 class="text-center" style="padding: 0px 0px 0px 0px;">選課系統</h1>
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
                <div class="container">
                    <form method="post" class="login" >
                      
                            <label for="Account" >學號:</label>
                            <input type="text" name="loginaccount" class="form-control" placeholder="輸入學號" id="Account">
                        
                            <label for="Password" >密碼:</label>
                            <input type="Password" name="loginpassword" class="form-control" placeholder="輸入密碼" id="Password">
                            <br>
                        <button type="submit" class="btn btn-outline-primary">確認</button>
                    </form>
                    <br>
                    <hr>
                    <div class="alert alert-danger" role="alert">
                        <p>還沒註冊嗎? &emsp; 前往<span><strong><a href="register.php">註冊</a></strong></span></p>
                    </div>
                </div>
                <br>
                <?php

                $la = "";
                $lp = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $la = test_input($_POST["loginaccount"]);
                    $lp = test_input($_POST["loginpassword"]);
                }

                function test_input($data) {
                    // $data = trim($data);
                    // $data = stripslashes($data);
                    // $data = htmlspecialchars($data);
                    return $data;
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'function1.php';
                $conn = opDB();
                $sqlre = "SELECT stuid,pwd FROM students";
                $acc = "";
                $pas = "";
                $check = '0';
                if($result = mysqli_query($conn, $sqlre)){
                    if (mysqli_num_rows($result) > 0) {       
                      while($row = mysqli_fetch_assoc($result)){
                        if($row["stuid"] == $la && $row["pwd"] == $lp){
                            $acc = $row["stuid"];
                            $pas = $row["pwd"];
                            $userData = Array('user'=> $acc );
                            $_SESSION['userData']=$userData;
                            $check = '1';
                        }
                      }
                    }     
                }
                if( $check == '1'){
                    echo "<script type='text/javascript'>";
                    echo "window.location.href='connect.php'";
                    echo "</script>"; 
                    }else{
                        echo "<script type='text/javascript'>";
                        echo "alert('您輸入的帳號或密碼有錯');";
                        echo "</script>"; 
                    }
                }
                ?>
                <!-- <h1>123456</h1> -->
                <!-- <?php
                  include 'function1.php'; 
                  $conn = opDB();

                  CloseCon($conn);


                    
                ?> -->
            </main>
        </div>
    </div>


</body>
</html>
