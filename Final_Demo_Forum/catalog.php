<?php
    require("DBconnect.php");
    session_start();

    if (isset($_SESSION["admin_login"])){
        $uId = $_SESSION["admin_login"];
    }
    else{
        if (isset($_SESSION["premium_login"])){
            $uId = $_SESSION["premium_login"];
        }
        else{
            if (isset($_SESSION["user_login"])){
                $uId = $_SESSION["user_login"];
            }else{
                $uId = "null";
            }
        }
    }

    $tNo = $_GET["tNo"];

    echo 
    "
    <html>
        <head>
            <meta charset='utf-8'>
            <title>JKL論壇：分類</title>

            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
            <link rel='stylesheet' href='theme.css'>
        </head>

        <body>
            <script src='https://code.jquery.com/jquery.js'></script>
            <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
            <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>

            <nav class='navbar navbar-expand-md navbar-light bg-white fixed-top'>
                <!--  這是 LOGO 文字或圖片  -->
                <a href='index.php' class='navbar-brand' style='margin-left: 35px'><img src='icon.png' height='45'></a>
                <p style='margin-top: 15px'>JKL論壇</p>

                <!--  這是手機版時右上角呈現的選單按鈕, 注意:data-target表示按下這個按鈕時要控制展開收合的物件ID名稱  -->
                <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <!-- 這是按鈕上呈現的icon圖案 -->
                <span class='navbar-toggler-icon'></span>
                </button>
                
                <!-- navbar-collapse表示這個框架區塊是可收展開的, 注意:id名稱必須跟button中的data-target一樣 -->
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <!-- 這是一組靠左側的選單 -->
                    <ul class='navbar-nav mr-auto' style='margin-left: 400px; margin-right: 50px'>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php'>首頁</a>
                        </li>

                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>分類</a>
                            <div class='dropdown-menu dropdown-menu-dark' aria-labelledby='navbarDropdownMenuLink'>
    ";

    $SQL_all_type = "SELECT * FROM type";
    
    if($result = mysqli_query($link,$SQL_all_type)){
        while($row = mysqli_fetch_assoc($result)){
            echo "<a class='dropdown-item' href='catalog.php?tNo=".$row["tNo"]."' style='color: black'>".$row["tName"]."</a>";
            if($tNo == $row["tNo"]){
                $tName = $row["tName"];
                $tPic = $row["tPic"];
                $tFollow = $row["numFollow"];
                $tPost = $row["numPost"];
            }
        }
    }
                    

    echo
    "
                    </div>
                </li>

                <li class='nav-item'>
                    <a class='nav-link' href='member.php'>會員中心</a>
                </li>
            </ul>
    ";

    $followed = 0;
    
    if($uId != "null"){
        $SQL_user = "SELECT * FROM forum_account WHERE uId = '$uId'";
        if($result = mysqli_query($link,$SQL_user)){
            while($row = mysqli_fetch_assoc($result)){
                $uPic = $row["ppath"];
                $uName = $row["uName"];
                $uNo = $row["uNo"];

                $SQL_follow = "SELECT COUNT(*) AS num FROM follow WHERE uNo = '$uNo' AND fNo = '$tNo'";
                if($result = mysqli_query($link,$SQL_follow)){
                    $row = mysqli_fetch_assoc($result);
                    if($row["num"] > 0){
                        $followed = 1;
                    }
                }
            }
        }

        echo
        "
                <a href='member.php' class='user'><img src='".$uPic."' height='40' alt='logo'></a>
                <div style='margin-right: 20px'>用戶：".$uName."</div>
                <a class='btn btn-outline-secondary' href='logout.php' role='button' style='margin-right: 60px'>登出</a>
            </div>
        </nav>

        <section>
        <div style='border:2px black solid'>
            <div style='display:inline-block'>
                <img src='".$tPic."' height='200' alt='logo' class='catalog_pic'>
            </div>
            <div style='display:inline-block'>    
                <h2>".$tName."</h2>
                <h4 style='padding-top: 10px'>".$tPost."篇文章 ".$tFollow."人追蹤</h4>
            </div> 
            <div class='catalog_button'>    
        ";
        
        if($followed == 0){
            echo
            "
                    <a href='follow.php?tNo=".$tNo."& followed=".$followed."' style='padding-right: 30px'><h2 style='display: inline; color:#FF5151'>追蹤</h2></a>
            ";
        }else{
            echo
            "
                    <a href='follow.php?tNo=".$tNo."& followed=".$followed."' style='padding-right: 30px'><h2 style='display: inline; color:black'>已追蹤</h2></a>
            ";
        }
        
                
        echo
        "
                <a href='post.php?tNo=".$tNo."'><h2 style='display: inline; color:#0080FF'>發表文章</h2></a>
            </div>   
        </div>
        ";
    }else{
        echo
        "
                <a class='btn btn-primary login_register' href='login.php' role='button' style='margin-right: 60px'>登入</a>
                <a class='btn btn-outline-secondary' href='pre_register.php' role='button' style='margin-right: 60px'>註冊</a>
            </div>
        </nav>

        <section>
        <div style='border:2px black solid'>
            <div style='display:inline-block'>
                <img src='".$tPic."' height='200' alt='logo' class='catalog_pic'>
            </div>
            <div style='display:inline-block'>    
                <h2>".$tName."</h2>
                <h4 style='padding-top: 10px'>".$tPost."篇文章 ".$tFollow."人追蹤</h4>
            </div> 
            <div class='catalog_button'>    
                <a href='login.php' style='padding-right: 30px'><h2 style='display: inline; color:#FF5151'>追蹤</h2></a>
                <a href='login.php'><h2 style='display: inline; color:#0080FF'>發表文章</h2></a>
            </div>   
        </div>
        ";
    }

    $SQL = "SELECT * FROM post WHERE tNo = '$tNo' ORDER BY pDate DESC";
    if($result = mysqli_query($link,$SQL)){
        while($row = mysqli_fetch_assoc($result)){
            $pNo = $row["pNo"];
            $uNo = $row["uNo"];
            $time = $row["pDate"];
            $title = $row["title"];
            $content = $row["content"];
            $pic = $row["pic"];
            $view = $row["sumView"];
            $comment = $row["sumComment"];

            $SQL_poster = "SELECT * FROM forum_account WHERE uNo = '$uNo'";
            if($result1 = mysqli_query($link,$SQL_poster)){
                while($row1 = mysqli_fetch_assoc($result1)){
                    $poster_pic = $row1["ppath"];
                    $poster = $row1["uName"];
                }
            }

            echo
            "
                <div style='border:1px #BEBEBE solid'>
                    <div class='catalog_post'>
                        <a href='text.php?pNo=".$pNo."'><h4>".$title."</h4></a>
            ";

            $arr = explode("\n",$content);
            $size = COUNT($arr);

            if($pic == "null"){
                echo
                "
                            <a href='text.php?pNo=".$pNo."'><h5 style='color: #BEBEBE; -webkit-line-clamp: 3'>
                ";

                $count = 0;
                while($count < 3){
                    echo $arr[$count]."<br>";
                    $count += 1;
                }            
                echo
                "...</h5></a>
                            <div style='margin: 25px 0 20px 15px; display:inline-block;'> 
                                <img src='".$poster_pic."' height='40' alt='logo'>
                                <h4 style='color: #BEBEBE; display: inline; padding-left: 5px'>".$poster."</h4>
                                <h4 style='color: #BEBEBE; display: inline; padding-left: 20px;'>".$time."</h4>
                                
                                <div style='display:inline-block; margin: -40px 0 0 500px;'>
                                    <img src='瀏覽.jpg' height='26' alt='logo'>
                                    <h4 style='color: #BEBEBE; display: inline'>".$view."</h4>

                                    <img src='留言.jpg' height='30' alt='logo'>
                                    <h4 style='color: #BEBEBE; display: inline'>".$comment."</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                ";                
            }else{
                echo
                "
                            <div style='float:left; width: 700px;'>
                                <div style='heigh: 40px'>
                                    <a href='text.php?pNo=".$pNo."'><h5 class='catalog_post_text'>".$content."</h5></a>
                                </div>

                                <div style='margin: 30px 0 0 15px; display:inline-block;'> 
                                    <img src='".$poster_pic."' height='40' alt='logo'>
                                    <h4 style='color: #BEBEBE; display: inline; padding-left: 5px'>".$poster."</h4>
                                    <h4 style='color: #BEBEBE; display: inline; padding-left: 20px;'>".$time."</h4>
                                    
                                    <div style='display:inline-block; margin: -40px 0 0 500px;'>
                                        <img src='瀏覽.jpg' height='26' alt='logo'>
                                        <h4 style='color: #BEBEBE; display: inline'>".$view."</h4>

                                        <img src='留言.jpg' height='30' alt='logo'>
                                        <h4 style='color: #BEBEBE; display: inline'>".$comment."</h4>
                                    </div>
                                </div>
                            </div>
                        
                            <img src='".$pic."' height='150' alt='logo' class='catalog_post_pic'>
                        </div>
                    </div>
                ";
            }
        }
    }

    echo
    "
        </section>
        
    </body>
    </html>
    ";

?>