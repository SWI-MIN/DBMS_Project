
        <?php
            header("Content-type: text/html; charset=utf-8");//頁面編碼
            $dbms='mysql';     //数据库类型
            $host='localhost'; //数据库主机名
            $dbName='dbms_project';    //使用的数据库
            $user='root';      //数据库连接用户名
            $pass='';          //对应的密码
            $dsn="$dbms:host=$host;dbname=$dbName";
            

            $stuid = $_POST['stuid'];                              //取得USER輸入的id
            $pwd = $_POST['pwd'];                                   //取得USER輸入的password
            $stuname = $_POST['stuname']; 
            $studepart = $_POST['studepart'];                              
            $stufloor = $_POST['stufloor'];                                   
            $stuclass = $_POST['stuclass'];

            if ($stuid == '' || $pwd == '' || $stuname == '' || $studepart == '' || $stufloor == '' || $stuclass == ''){
                echo '<script>alert("通通不能為空!!");history.go(-1);</script>';
                exit(0);
            } else {
                $conn = new mysqli($dsn, $user, $pass, $options);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }
                $sql = "INSERT INTO students (stuid, pwd, stuname, studepart, stufloor, stuclass)
                 VALUES ($stuid, $pwd, $stuname, $studepart, $stufloor, $stuclass);";
                $conn->prepare($sql)->execute([$stuid, $pwd, $stuname, $studepart, $stufloor, $stuname]);
                
            }  
            
        ?>
