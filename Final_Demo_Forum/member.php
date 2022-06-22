<?php
ob_start();
session_start();    

include_once ("DBconnect.php");

echo "<style>";
include ("theme.css");
echo "</style>";

echo "<meta charset='utf-8'>
<title>JKL論壇：會員管理</title>";

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

    if (isset($uId)){
    $sql = "SELECT * FROM forum_account WHERE uId = '$uId'";
    if ($result = mysqli_query($link, $sql)){
        while ($row = mysqli_fetch_assoc($result)){
            $uPwd = $row['uPwd'];
            $uNo = $row['uNo'];;
            if ($row['uRole'] == "admin"){
                $uRole = "管理員";
            }
            else{
                if ($row['uRole'] == "user"){
                    $uRole = "一般會員";
                }
                else{
                    if ($row['uRole'] == "premium"){
                        $uRole = "白金會員";
                    }
                }
            }
            $uName = $row['uName'];
            $uMail = $row['uMail'];
            if ($row['uGender'] == 1){
                $uGender = "男";
            }
            else{
                if ($row['uGender'] == 0){
                    $uGender = "女";
                }
            }
            $ppath = $row['ppath'];
            echo "<div class = 'wrap'><div class = 'block' style = 'text-align: center'>
            <img src = '".$row["ppath"]."' width = '25%' class = 'img'><br/>
            <a href = 'photo.php'>更新</a> <a href = 'photo.php?Id=1'>刪除</a>
            <div class = 'blockText'>";
            echo "會員類型：".$uRole."<br/><br/>";
            echo "帳號：".$uId."<br/><br/>";
            echo "密碼：".$uPwd."<a href = 'update.php?Id=0'> 修改密碼</a><br/><br/>";
            echo "暱稱：".$uName."<a href = 'update.php?Id=1'> 修改暱稱</a><br/><br/>";
            echo "性別：".$uGender."<br/><br/>";
            echo "信箱：".$uMail."<br/><br/>";
            echo "已收藏分類：";

            $SQL_follow = "SELECT * FROM follow WHERE uNo = '$uNo'";
            if ($result1 = mysqli_query($link, $SQL_follow)){
                while ($row1 = mysqli_fetch_assoc($result1)){
                    $tNo = $row1["fNo"];

                    $SQL_follow_type = "SELECT * FROM type WHERE tNo = '$tNo'";
                    if ($result2 = mysqli_query($link, $SQL_follow_type)){
                        while ($row2 = mysqli_fetch_assoc($result2)){
                            echo "<a href = 'catalog.php?tNo=".$tNo."'>".$row2["tName"]." </a>";
                        }
                    }
                }
            }

            echo "<br/><br/><a href = 'delete.php'>刪除帳號</a><br/><br/>";
            if (isset($_SESSION["admin_login"]) || isset($_SESSION["premium_login"])){
                echo "<a href = 'invite.php'>邀請</a>";
            }
            echo "</div></div></div>";
        }
    }
}
else{   
    echo "<script type = 'text/javascript'>";
    echo "alert('您尚未登入！請在登入後重試')";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content ='0; url=login.php'>";
}


ob_flush();
?>