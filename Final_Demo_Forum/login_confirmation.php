<?php
ob_start();
session_start();
require ("DBconnect.php");

if (isset($_POST["uId"])){
    $uId = $_POST["uId"];
    $uPwd = $_POST["uPwd"];
    if ($uId != NULL && $uPwd != NULL){
        $sql = "SELECT * FROM forum_account WHERE uId = '$uId' AND uPwd = '$uPwd'";
        if ($result = mysqli_query($link, $sql)){
            while($row = mysqli_fetch_assoc($result)){
                $uRole = $row['uRole'];
            }
        }
        if (mysqli_num_rows($result) != 0){
            setcookie("credentials", $uId, time()+3600);
            if ($uRole == "user"){
                $_SESSION ["user_login"] = $uId;
            }
            else{
                if ($uRole == "premium"){
                    $_SESSION ["premium_login"] = $uId;
                }
                else{
                    if ($uRole == "admin"){
                        $_SESSION ["admin_login"] = $uId;
                    }
                }
            }
            echo "<script type = 'text/javascript'>";
            echo "alert('登入成功！')";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content ='0; url=index.php'>";
        }
        else{
            echo "<script type = 'text/javascript'>";
            echo "alert('帳號或密碼有誤！')";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content ='0; url=login.php'>";
        }
    }
    else{
        echo "<script type = 'text/javascript'>";
        echo "alert('您尚未輸入帳號或密碼！')";
        echo "</script>";
        echo "<meta http-equiv='Refresh' content ='0; url=login.php'>";
    }
}

ob_flush();
?>