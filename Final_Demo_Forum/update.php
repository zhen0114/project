<?php
ob_start();
session_start();

include_once ("DBconnect.php");

$Id = $_GET['Id'];

echo "<style>";
include ("form.css");
echo "</style>";

echo "<meta charset='utf-8'>
<title>JKL論壇：更新會員資料</title>";

if (isset($_SESSION["admin_login"]) || isset($_SESSION["premium_login"]) || isset($_SESSION["user_login"])){
    if ($Id == 0){
        echo "
        <div class='form'>
        <form action = 'update_confirmation.php?Id=0' method = 'post'>
            <div class='title'>密碼修改</div>
            <div class='input-container ic2'>
                <input type = 'password' name = 'uPwd_old' class = 'input' placeholder = ' '/>
                <div class = 'cut'></div>
                <label for = '' class= 'placeholder'>舊密碼</label>
            </div>
            <div class='input-container ic2'>
                <input type = 'password' name = 'uPwd_new' class = 'input' placeholder = ' '/>
                <div class = 'cut'></div>
                <label for = '' class= 'placeholder'>新密碼</label>
            </div>
            <div class='input-container ic2'>
                <input type = 'password' name = 'uPwd_new_confirm' class = 'input' placeholder = ' '/>
                <div class = 'cut'></div>
                <label for = '' class= 'placeholder'>確認新密碼</label>
            </div>
            <input type = 'submit' value = '送出' class = 'submit'/>
        </form>
    </div>
        ";
    }
    else{
        if ($Id == 1){
            echo "
            <div class='form'>
                <form action = 'update_confirmation.php?Id=1' method = 'post'>
                    <div class='title'>暱稱修改</div>
                    <div class='input-container ic2'>
                        <input type = 'text' name = 'uName_new' class = 'input' placeholder = ' '/>
                    <div class = 'cut'></div>
                        <label for = '' class= 'placeholder'>新暱稱</label>
                    </div>
                    <input type = 'submit' value = '送出' class = 'submit'/>
                </form>
            </div>      
            ";
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