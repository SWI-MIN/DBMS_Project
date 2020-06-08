<?php
    session_start();
    if(isset($_SESSION['userData'])){

        if($_POST['logout']){
            unset($_SESSION['userData']);//直接unset，或可用session里面的函数
            echo "<script>window.location.href='login_index.php';</script>";
        } else{
            echo "<script>window.location.href='login_index.php';</script>";
        }

    } else{
        echo "<script>window.location.href='login_index.php';</script>";
        }
    
?>