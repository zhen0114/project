<?php
ob_start();
session_start();

echo "<style>";
include ("form.css");
echo "</style>";

echo "<meta charset='utf-8'>
<title>JKL論壇：會員註冊</title>";

if (isset($_SESSION["admin_login"]) || isset($_SESSION["premium_login"]) || isset($_SESSION["user_login"])){
    echo "<meta http-equiv = 'refresh' content = '5; url = index.php'>";
    echo "<div class = 'title' style = 'text-align: center'>歡迎回來！<br/><br/>您已登入，將跳轉頁面至JKL論壇<br/><br/>
    若網頁無自動跳轉<a href = 'index.php'>請點此</a></div>";
}
else{
    $str = "一般";
    if (isset($_GET["reg"])){
        $reg = $_GET["reg"];
        if ($reg == 1){
            $str = "白金";
        }
    }
    echo "<div class='form_long'>
    <form action = 'reg_confirmation.php' method = 'post'>
        <div class='title'>".$str."會員註冊</div>
        <div class='subtitle'><a href = 'index.php'>歡迎來到JKL論壇</a></div>
        <div class='input-container ic1'>
          <input type='text' name ='uId' class = 'input' placeholder = ' '/>
          <div class='cut'></div>
          <label for = '' class= 'placeholder'>帳號</label>
        </div>
        <div class='input-container ic2'>
          <input type = 'password' name = 'uPwd' class = 'input' placeholder = ' '/>
          <div class = 'cut'></div>
          <label for = '' class= 'placeholder'>密碼</label>
        </div>
        <div class='input-container ic1'>
          <input type='text' name ='uName' class = 'input' maxLength = '10' placeholder = ' '/>
          <div class='cut'></div>
          <label for = '' class= 'placeholder'>暱稱</label>
        </div>
        <div class='input-container ic2'>
          <input type='text' name ='uMail' class = 'input' placeholder = ' '/>
          <div class='cut'></div>
          <label for = '' class= 'placeholder'>信箱</label>
        </div>
        ";

    if (isset($reg) && $reg == 1){
        echo "<div class='input-container ic2'>
        <input type='text' name ='invitCode' class = 'input' placeholder = ' '/>
        <div class='cut'></div>
        <label for = '' class= 'placeholder'>邀請碼</label>
        </div>
        <div class='container'>
          <label><input type='radio' name='uGender' checked/><span>男</span></label>
          <label><input type='radio' name='uGender'/><span>女</span></label>
        </div>";
        echo "<input type = 'hidden' name = 'uRole' value = 'premium' required/>";
    }
    else{
        echo "
        <div class='container'>
          <label><input type='radio' name='uGender' checked/><span>男</span></label>
          <label><input type='radio' name='uGender'/><span>女</span></label>
        </div>";
        echo "<input type = 'hidden' name = 'uRole' value = 'user' required/>";
    }
    echo "<input type = 'submit' value = '註冊' class = 'submit'/>";
    echo "</form>
    </div>";
}

ob_flush();
?>

<!-- <input type='radio' name ='uGender' class = '' value = 1 />男
<input type='radio' name ='uGender' class = '' value = 0 />女 -->