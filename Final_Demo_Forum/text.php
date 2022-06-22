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
    
    $pNo = $_GET["pNo"];

    echo 
    "
    <html>
        <head>
            <meta charset='utf-8'>
            <title>JKL論壇：文章</title>

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

    if($uId != "null"){
        $SQL_user = "SELECT * FROM forum_account WHERE uId = '$uId'";
        if($result = mysqli_query($link,$SQL_user)){
            $row = mysqli_fetch_assoc($result);
            $uPic = $row["ppath"];
            $uName = $row["uName"];
            $uNo = $row["uNo"];
        }

        $SQL_had_viwe = "SELECT COUNT(*) AS view_num FROM view WHERE vNo = '$pNo' AND uNo = '$uNo'";
        if($result1 = mysqli_query($link,$SQL_had_viwe)){
            
            $row1 = mysqli_fetch_assoc($result1);
            if($row1["view_num"] == 0){

                $SQL_view_new = "INSERT INTO view(vNo,uNo) VALUE ('$pNo','$uNo')";
                if($result2 = mysqli_query($link,$SQL_view_new)){

                    $SQL_view = "SELECT COUNT(*) AS view_count FROM view WHERE vNo = '$pNo'";
                    if($result3 = mysqli_query($link,$SQL_view)){
                        $row3 = mysqli_fetch_assoc($result3);
                        $view_count = $row3["view_count"];
    
                        $SQL_post_new_view = "UPDATE post SET sumView = '$view_count' WHERE pNo = '$pNo'";
                        if($result2 = mysqli_query($link,$SQL_post_new_view)){
                        }else{
                            echo "<meta http-equiv = 'Refresh' content = '0; url = text.php?pNo=".$pNo."'>";
                        }
                    }
                }

            }else{
            }   
        }

        echo
        "
                <a href='member.php' class='user'><img src='".$uPic."' height='40' alt='logo'></a>
                <div style='margin-right: 20px'>用戶：".$uName."</div>
                <a class='btn btn-outline-secondary' href='logout.php' role='button' style='margin-right: 60px'>登出</a>
            </div>
        </nav>
        ";
    }else{
        echo
        "
                <a class='btn btn-primary login_register' href='login.php' role='button' style='margin-right: 60px'>登入</a>
                <a class='btn btn-outline-secondary' href='pre_register.php' role='button' style='margin-right: 60px'>註冊</a>
            </div>
        </nav>
        ";
    }

    $SQL = "SELECT * FROM post WHERE pNo = '$pNo'";
    if($result = mysqli_query($link,$SQL)){
        while($row = mysqli_fetch_assoc($result)){
            $time = $row["pDate"];
            $title = $row["title"];
            $content = $row["content"];
            $pic = $row["pic"];
            $view = $row["sumView"];
            $comment = $row["sumComment"];
            $posterNo = $row["uNo"];

            $SQL_poster = "SELECT * FROM forum_account WHERE uNo = '$posterNo'";
            if($result1 = mysqli_query($link,$SQL_poster)){
                while($row1 = mysqli_fetch_assoc($result1)){
                    $poster_pic = $row1["ppath"];
                    $poster = $row1["uName"];
                }
            }
        }
    }

    echo
    "
    <section>
        <div style='border:1px #BEBEBE solid'>
            <div class='catalog_post'>
                <h4>".$title."</h4>

                <div style='padding-top: 15px;'> 
                    <img src='".$poster_pic."' height='40' alt='logo'>
                    <h4 style='color: #BEBEBE; display: inline; padding-left: 5px'>".$poster."</h4>
                    <h4 style='color: #BEBEBE; display: inline; padding-left: 20px;'>".$time."</h4>
                        
                    <div style='display:inline-block; padding-left: 200px; margin-bottom: 30px'>
                        <img src='瀏覽.jpg' height='26' alt='logo'>
                        <h4 style='color: #BEBEBE; display: inline'>".$view."</h4>

                        <img src='留言.jpg' height='30' alt='logo'>
                        <h4 style='color: #BEBEBE; display: inline'>".$comment."</h4>
                    </div>
                </div>
            </div>
        </div>

        <div style='border:1px #BEBEBE solid'>
            <div class='catalog_post'>
                <h5 class='post_text'>
    ";

    $arr = explode("\n",$content);
    $size = COUNT($arr);
    $count = 0;
    
    while($count != $size){
        echo $arr[$count]."<br>";
        $count += 1;
    }            
    echo
    "
                </h5>
            </div>
    ";

    if($pic != "null"){
        echo
        "
        <img src='".$pic."' height='200' style='margin-bottom: 20px; margin-left: 60px'>
        ";
    }

    echo
    "
    </div>

    <div style='border:1px #BEBEBE solid'>
        <div class='catalog_post'>
            <img src='留言.jpg' height='30' alt='logo' style='margin-bottom: 5px'>
            <h4 style='color: #BEBEBE; display: inline'>".$comment."</h4>
        </div>
    </div>
    ";

    if($comment > 0){
        $SQL_comment = "SELECT * FROM comment WHERE cNo = '$pNo'";
    
        if($result = mysqli_query($link,$SQL_comment)){
            while($row = mysqli_fetch_assoc($result)){
                $posterNo_comment = $row["uNo"];
                $time_comment = $row["cDate"];
                $message = $row["message"];

                $SQL_poster_comment = "SELECT * FROM forum_account WHERE uNo = '$posterNo_comment'";
                if($result = mysqli_query($link,$SQL_poster_comment)){
                    while($row = mysqli_fetch_assoc($result)){
                        $poster_pic_comment = $row["ppath"];
                        $poster_comment = $row["uName"];
                    }
                }

                echo
                "
                <div style='border:1px #BEBEBE solid'>
                    <div class='catalog_post' style='padding-bottom: 20px'>
                        <img src='".$poster_pic_comment."' height='40' alt='logo'>
                        <h4 style='color: #BEBEBE; display: inline; padding-left: 5px'>".$poster_comment."</h4>
                        <h4 style='color: #BEBEBE; display: inline; padding-left: 20px;'>".$time_comment."</h4>
                    </div>

                    <div class='catalog_post'>
                        <h5 class='post_text'>".$message."</h5>
                    </div>
                </div>
                ";
            }
        }
    }

    if($uId != "null"){
        echo
        "
                    <div class='catalog_post'>
                        <form action='commentinfo.php?postNum=".$pNo."' method='post'>
                            <textarea style='resize:none;width:600px;height:200px' name='uComment' required></textarea><br><br>
                            <input type='submit' value='發佈'>
                        </form>
                    </div>
                </section>
            </body>
        </html>
        ";
    }else{
        echo
        "
                    <div class='catalog_post'>
                        <div class='text_comment_area'>
                            <h4 style='line-height:200px; display: inline'>登入後才可回覆 </h4>
                            <a href='login.php'><h4 class='text_comment_link'>登入</h4></a>
                            <h4 style='line-height:200px; display: inline'>|</h4>
                            <a href='pre_register.php'><h4 class='text_comment_link'>註冊</h4></a>
                        </div><br>
                        <input type='button' value='發佈'>
                    </div>

                </section>
            </body>
        </html>
        ";
    }
?>