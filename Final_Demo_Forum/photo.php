<?php
ob_start();
session_start();    

include_once ("DBconnect.php");

echo "<style>";
include ("theme.css");
echo "</style>";

echo "<meta charset='utf-8'>
<title>JKL論壇：頭貼更新</title>";

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

if (isset($_GET['Id'])){
    $Id = $_GET['Id'];
}

echo 
    "
    <html>
        <head>
            <meta charset='utf-8'>
            <title>JKL論壇：首頁</title>

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

    if($uId != "null" || isset($uId)){

        $uPic = "";
        $uName = "";
        $SQL_user = "SELECT * FROM forum_account WHERE uId = '$uId'";
        if($result = mysqli_query($link,$SQL_user)){
            while($row = mysqli_fetch_assoc($result)){
                $uPic = $row["ppath"];
                $uName = $row["uName"];
            }
        }

        if (isset($Id) && $Id == 1){
            echo
        "
                <a href='member.php' class='user'><img src='".$uPic."' height='40' alt='logo'></a>
                <div style='margin-right: 20px'>用戶：".$uName."</div>
                <a class='btn btn-outline-secondary' href='logout.php' role='button' style='margin-right: 60px'>登出</a>

            </div>
        </nav>
        ";
            echo "<meta http-equiv = 'refresh' content = '0; url = photo_update.php?Id=1'>";
        }
        else{
            echo
            "
                <a href='member.php' class='user'><img src='用戶1.png' height='40' alt='logo'></a> <div style='margin-right: 20px'>用戶：".$uId."</div>
                <a class='btn btn-outline-secondary' href='logout.php' role='button'>登出</a>
            </div>
            </nav>
            ";
        
            echo "<div class = 'wrap'><div class = 'block_small' style = 'text-align: center'><div class = 'blockText_small'>";
            echo 
            "
            <form action = 'photo_update.php' method = 'post' enctype = 'multipart/form-data'>
            <input type = 'file' name = 'photo' accept = 'image/*' required/>
            <input type = 'submit' value = '更新'/>
            </form>
            ";
            echo "</div></div></div>";
        }

        
    }else{
        echo "<script type = 'text/javascript'>";
        echo "alert('您尚未登入！請在登入後重試')";
        echo "</script>";
        echo "<meta http-equiv='Refresh' content ='0; url=login.php'>";
    }

ob_flush();
?>