<?php
ob_start();
session_start();
echo "<style>";
include ("float.css");
echo "</style>";

echo "<meta charset='utf-8'>
<title>JKL論壇：選擇帳戶類型</title>";

if (isset($_SESSION["admin_login"]) || isset($_SESSION["premium_login"]) || isset($_SESSION["user_login"])){
    echo "<meta http-equiv = 'refresh' content = '5; url = index.php'>";
    echo "<div class = 'title' style = 'text-align: center'>歡迎回來！<br/><br/>您已登入，將跳轉頁面至JKL論壇<br/><br/>
    若網頁無自動跳轉<a href = 'index.php'>請點此</a></div>";
}
else{
    // echo "<div style = 'text-align: center'>
    // <a href = 'index.php'>logo</a><br/>
    // JKL論壇
    // <a href = 'login.php'>登入</a><br/>
    // <a href = 'pre_register.php'>註冊</a><br/>
    // -----------------------------------------------------
    // </div>";
    echo "
    <div class = 'wrap'>
    <div class = 'title'>----------請選擇帳戶類型----------</div>
    <br/><br/>
    <a href = 'register.php'><div class = 'block_left blockText'><br/>一般<br/>會員</div></a>
    <a href = 'register.php?reg=1'><div class = 'block_right blockText'><br/>白金<br/>會員</div></a>
    </div>";
}

ob_flush();
?>