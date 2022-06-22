<?php
ob_start();
session_start();

include_once ("DBconnect.php");

echo "<style>";
include ("theme.css");
echo "</style>";

echo "<meta charset='utf-8'>
<title>JKL論壇：刪除會員</title>";


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

if (isset($uId)){
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
    echo
    "
        <a href='member.php' class='user'><img src='用戶1.png' height='40' alt='logo'></a> <div style='margin-right: 20px'>用戶：".$uId."</div>
        <a class='btn btn-outline-secondary' href='logout.php' role='button'>登出</a>
    </div>
    </nav>
    ";
    echo "<div class = 'wrap'><div class = 'block' style = 'text-align: center'><div class = 'blockText2'>帳戶一經刪除，即無法復原<br/>您確定要刪除本帳號嗎？<br/><br/>";
    echo "<a href = 'delete_confirmation.php?uId=".$uId."'>確定</a>  <a href = 'member.php'>返回</a></div></div></div>";
}
else{
    echo "<script type = 'text/javascript'>";
    echo "alert('您尚未登入！請在登入後重試')";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content ='0; url=login.php'>";
}


ob_flush();
?>