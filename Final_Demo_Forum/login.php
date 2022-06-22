<?php
ob_start();
session_start();
echo "<style>";
include ("form.css");
echo "</style>";

if (isset($_SESSION["admin_login"]) || isset($_SESSION["premium_login"]) || isset($_SESSION["user_login"])){
    echo "<script type = 'text/javascript'>";
    echo "alert('您已登入！')";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content ='0; url=index.php'>";
}
else{
    echo
    "
    <meta charset='utf-8'>
    <title>JKL論壇：登入</title>
    
    <div class='form'>
      <form action = 'login_confirmation.php' method = 'post'>
          <div class='title'>登入</div>
          <div class='subtitle'><a href = 'index.php'>歡迎來到JKL論壇</a></div>
          <div class='input-container ic1'>
            <input type='text' name ='uId' class = 'input' placeholder = ' '/>
            <div class='cut'></div>
            <label for = '' class= 'placeholder'>請輸入帳號</label>
          </div>
          <div class='input-container ic2'>
            <input type = 'password' name = 'uPwd' class = 'input' placeholder = ' '/>
            <div class = 'cut'></div>
            <label for = '' class= 'placeholder'>請輸入密碼</label>
          </div>
          <input type = 'submit' value = '登入' class = 'submit'/>
          <div class = 'links'><br/>
            <div style = 'text-align: center;'><a href = 'pre_register.php'>去註冊</a></div>
          </div>

      </form>
    </div>
    ";
}
ob_flush();
?>