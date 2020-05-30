<?php
    $logout = $_POST['logout'];
    header("Content-type:text/html;charset=utf-8");
    session_start();
    if($logout){
        unset($_SESSION['echo']);//直接unset，或者用session里面的函数，我没试过
        echo "<script>window.location.href='login.html';</script>";
    }
    
?>