<?php
    $logout = $_POST['logout'];
    header("Content-type:text/html;charset=utf-8");
    session_start();
    if($logout){
        unset($_SESSION['echo']);//直接unset，或可用session里面的函数
        echo "<script>window.location.href='login_index.php';</script>";
    }
    
?>