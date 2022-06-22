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
            }
        }
    }
    $SQL_user = "SELECT * FROM forum_account WHERE uId = '$uId'";
    if($result = mysqli_query($link,$SQL_user)){
        while($row = mysqli_fetch_assoc($result)){
            $uPic = $row["ppath"];
            $uName = $row["uName"];
        }
    }

    $tNo = $_GET["tNo"];
    $_SESSION["type"] = $tNo;
    $SQL_type = "SELECT DISTINCT * FROM type WHERE tNo = '$tNo'";
    if($result = mysqli_query($link,$SQL_type)){
        while($row = mysqli_fetch_assoc($result)){
            $type = $row["tName"];
        }
    }

    echo 
    "
    <html>
        <head>
            <meta charset='utf-8'>
            <title>JKL論壇：發文</title>

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
                            <a class='nav-link' href='#'>會員中心</a>
                        </li>
                    </ul>
                        <a href='catalog.php' class='user'><img src='".$uPic."' height='40' alt='logo'></a>
                        <div style='margin-right: 20px'>用戶：".$uName."</div>
                        <a class='btn btn-outline-secondary' href='logout.php' role='button' style='margin-right: 60px'>登出</a>

                    </div>
                </nav>
    ";

    echo
    "
    <section>
        <form action='postinfo.php?tNo=".$tNo."' method='post'>
            <h2 style='margin-left: 60px;'>文章分類：".$type."</h2><br>
            
            <div style='margin-left: 60px;'>
                <h2 style='display: inline'>標題：</h2>
                <textarea style='resize:none;width:600px;height:30px' name='Title' maxlength='50' required></textarea><br><br>
            </div>

            <div style='margin-left: 60px;'>
                <h2 style='display: inline; vertical-align: top'>內容：</h2>
                <textarea style='resize:none;width:600px;height:200px' name='Content' maxlength='10000' required></textarea><br><br><br><br>
            </div>

            <div style='margin-left: 60px;'>
                <input type = 'file' name = 'photo' accept = 'image/*'/><br><br><br>
            </div>

            <input type='submit' value='發佈' style='margin-left: 60px;'>
        </form>
    </section>
    ";

?>