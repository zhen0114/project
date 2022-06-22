<?php
ob_start();
session_start();

require ("DBconnect.php");

echo "<style>";
include ("theme.css");
echo "</style>";

echo "<meta charset='utf-8'>
<title>JKL論壇：邀請會員</title>";

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
<nav class='navbar navbar-expand-md navbar-light bg-white fixed-top'>
    <!--  這是 LOGO 文字或圖片  -->
    <a href='index.php' class='navbar-brand' style='margin-left: 35px'><img src='icon.png' height='45'></a>

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
                <a class='nav-link' href='index.php'>Home <span class='sr-only'></span></a>
            </li>

            <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>menuItem</a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                    <a class='dropdown-item' href='#'>Action</a>
                    <a class='dropdown-item' href='#'>Another action</a>
                    <a class='dropdown-item' href='#'>Something else here</a>
                </div>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href='#'>menuItem</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='#'>menuItem</a>
            </li>
        </ul>
";

if (isset($uId)){
    echo
    "
        <a href='member.php' class='user'><img src='用戶1.png' height='40' alt='logo'></a> <div style='margin-right: 20px'>用戶：".$uId."</div>
        <a class='btn btn-outline-secondary' href='logout.php' role='button'>登出</a>
    </div>
    </nav>
    ";
    if (isset($_SESSION["premium_login"]) || isset($_SESSION["admin_login"])){
        $invitation_code = codeGenerator(24);
        echo "邀請碼頁面<br/>";
        echo "<div class = 'wrap'><div class = 'block' style = 'text-align: center'><div class = 'blockText2'><form action = 'invite_confirmation.php' method = 'post'>";
        echo "<p>請輸入對方信箱：<input type = 'text' name = 'reg_email' required/></p>";
        echo "<input type = 'hidden' name = 'code' value = '".$invitation_code."'/>";
        echo "<input type = 'submit' value = '送出'/><br/></div></div></div>";
    }
    else{
        if (isset($_SESSION["user_login"])){
            echo "<div class = 'wrap'><div class = 'block' style = 'text-align: center'><div class = 'blockText'>您沒有訪問此頁面的權限！  <a href = 'index.php'>回首頁</a></div></div></div>";
            exit();
        }
    }
}
else{
    echo
    "
        <a href='member.php' class='user'><img src='用戶1.png' height='40' alt='logo'></a> <div style='margin-right: 20px'>訪客</div>
        <a class='btn btn-outline-secondary' href='login.php' role='button'>登入</a>
    </div>
    </nav>
    ";
    echo "<div class = 'wrap'><div class = 'block' style = 'text-align: center'><div class = 'blockText'>訪客沒有訪問此頁面的權限！請<a href = 'login.php'>登入</a></div></div></div>";
    exit();
}
ob_flush();


function codeGenerator($length){
    $chars = "0123456789abcdefghijklmnopqrstuvwxyz";
    $invitor = $_COOKIE["credentials"];
    $invitation_code = $invitor."+";
    for ($i = 0; $i < $length; $i++){
        $invitation_code .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    return $invitation_code;
}
?>